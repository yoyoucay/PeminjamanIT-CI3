/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./application/view/**/*.{php}'],
  theme: {
    fontFamily: {
      satoshi: ['Satoshi', 'sans-serif'],
    },
    screens: {
      '2xsm': '375px',
      xsm: '425px',
      '3xl': '2000px',
      ...defaultTheme.screens,
    },
    extend: {},
  },
  plugins: [],
}

