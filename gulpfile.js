const { dirname, join } = require('path');
const { watch, parallel, series } = require('gulp');
const { rollup } = require('rollup');
const resolve = require('rollup-plugin-node-resolve');
const CleanCSS = require('clean-css');
const terser = require('terser');
const fs = require('fs');
const postcss = require('postcss');
const postcssPresetEnv = require('postcss-preset-env');
const postcssImport = require('postcss-import');
const cssDeclarationSorter = require('css-declaration-sorter');
const archiver = require('archiver');

async function js() {
    const options = {
        index: 'assets/js/index.js',
        outputDir: 'dist/'
    }

    // Bundle
    const bundle = await rollup({
        input: options.index,
        plugins: [ resolve() ]
    });

    const { output } = await bundle.generate({ format: 'iife' });

    // Minify
    const { code } = await terser.minify(output[0].code, {
        warnings: 'verbose',
        compress: {
            ecma: 6,
        },
        output: {
            comments: false,
            beautify: false
        }
    });

    // Save
    await fs.promises.mkdir(options.outputDir, { recursive: true });
    await fs.promises.writeFile(`${options.outputDir}bundle.min.js`, code);
}

async function processCss(options) {
    let result = '';
    const css = await fs.promises.readFile(options.index, 'utf-8');

    // Preprocess
    const postcssResult = await postcss([
        postcssImport(),
        postcssPresetEnv({
            stage: false,
            features: {
                'custom-media-queries': true,
                'media-query-ranges': true,
            }
        }),
        cssDeclarationSorter()
    ]).process(css, {
        from: options.index
    });

    result = postcssResult.css;

    // Minify
    const cleancss = new CleanCSS({
        returnPromise: true,
        level: {
            2: {
                mergeSemantically: true
            }
        }
    });

    let { styles } = await cleancss.minify(postcssResult.css);

    if (typeof options.after === 'function') {
        styles = options.after(styles);
    }

    // Save
    await fs.promises.mkdir(dirname(options.output), { recursive: true });
    await fs.promises.writeFile(options.output, styles);
}

async function css() {
    return processCss({
        index: 'assets/css/index.css',
        output: 'dist/bundle.min.css',
    });
}

async function editorCss() {
    await processCss({
        index: 'assets/css/index-editor-block.css',
        output: 'dist/bundle-editor-block.min.css',
        after: styles => {
            return styles.replace(/\.typeset /g, 'body .block-editor-block-list__layout ');
        }
    });
}

async function getThemeInfo() {
    const data = await fs.promises.readFile('style.css', 'utf-8');
    const matches = [ ...data.matchAll(/^([a-zA-Z ]+): (.*)$/gm) ];

    return matches
        .reduce((prev, item) => {
            prev[item[1].trim()] = item[2].trim();

            return prev;
        }, {});
}

async function pack() {
    const info = await getThemeInfo();
    const name = info['Theme Name'].toLowerCase();
    const version = info['Version'];

    const outputDir = 'releases';
    const outputPath = join(outputDir, `${name}-${version}.zip`);

    await fs.promises.mkdir(outputDir, { recursive: true });

    return new Promise(async (resolve, reject) => {
        const output = fs.createWriteStream(outputPath);
        const archive = archiver('zip', {
            zlib: { level: 9 }
        });

        archive.on('end', _ => {
            console.log(`Output archive: ${outputPath}`);
            resolve();
        });
        archive.on('error', reject);

        archive.glob(
            '**/*',
            { ignore: [ `${outputDir}/**`, 'node_modules/**', '.gitignore', 'gulpfile.js', '*.json', 'README.md' ] },
            { prefix: `${name}/` }
        );
        archive.pipe(output);
        archive.finalize();
    });
}

function watchAll() {
    watch('assets/js/**/*.js', js);
    watch('assets/css/**/*.css', parallel(css, editorCss));
}

exports.js = js;
exports.css = css;
exports.editorcss = editorCss;
exports.build = parallel(js, css, editorCss);
exports.pack = pack;
exports.release = series(parallel(js, css, editorCss), pack);
exports.watch = watchAll;
exports.default = exports.build;