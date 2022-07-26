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
                5: "5rem",
                6: "6rem",
                7: "7rem",
                8: "8rem",
            },
            width: {
                22: "5.5rem",
            },
        },
    },
    plugins: [],
};
