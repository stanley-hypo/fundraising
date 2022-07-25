/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            /* lewis: customization */
            minWidth: {
                8: "8rem",
            },
        },
    },
    plugins: [require("tw-elements/dist/plugin")],
};
