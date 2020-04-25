// https://gist.github.com/ahtcx/0cd94e62691f539160b32ecda18af3d6
export function merge(target, source) {
    for (const key of Object.keys(source)) {
        if (source[key] instanceof Object) {
            Object.assign(source[key], merge(target[key], source[key]));
        }
    }

    Object.assign(target || {}, source);

    return target;
}

export function domReady(fn) {
    if (document.readyState === 'interactive' || document.readyState === 'complete') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn, false);
    }
}