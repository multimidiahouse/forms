/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.slugify = function(obj) {
    let string = obj.value;
    let b = string.replace(/[^a-z0-9-]/gi,'');
    obj.value = b;
    return b;
}
