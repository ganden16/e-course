/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#009b77',
          600: '#059669',
          700: '#174e47',
          800: '#065f46',
          900: '#064e3b',
          950: '#022c22',
          DEFAULT: '#009b77',
          dark: '#174e47',
          light: '#d1fae5'
        },
        secondary: {
          DEFAULT: '#ffb433',
          dark: '#ff9500',
          light: '#ffe8cc'
        },
        accent: {
          DEFAULT: '#ffb433',
          dark: '#ff9500'
        },
        orange: {
          50: '#fff7ed',
          100: '#ffedd5',
          200: '#fed7aa',
          300: '#fdba74',
          400: '#fb923c',
          500: '#ffb433',
          600: '#ff9500',
          700: '#ea580c',
          800: '#c2410c',
          900: '#9a3412',
          950: '#7c2d12',
          DEFAULT: '#ffb433',
          dark: '#ff9500',
          light: '#ffe8cc'
        },
        beige: {
          DEFAULT: '#fcf8ef',
          light: '#fefcf9',
          dark: '#faf4e8'
        },
        dark: {
          DEFAULT: '#064e3b',
          light: '#065f46'
        },
        light: {
          DEFAULT: '#fcf8ef',
          dark: '#faf4e8'
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
    //   animation: {
    //     'float': 'float 3s ease-in-out infinite',
    //     'pulse-slow': 'pulse 2s ease-in-out infinite',
    //   },
    //   keyframes: {
    //     float: {
    //       '0%': { transform: 'translateY(0px)' },
    //       '50%': { transform: 'translateY(-10px)' },
    //       '100%': { transform: 'translateY(0px)' }
    //     },
    //     pulse: {
    //       '0%': { transform: 'scale(1)' },
    //       '50%': { transform: 'scale(1.05)' },
    //       '100%': { transform: 'scale(1)' }
    //     }
      },
      backgroundImage: {
        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
        'gradient-conic':
          'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
        'gradient-green': 'linear-gradient(135deg, #009b77 0%, #174e47 100%)',
        'gradient-orange': 'linear-gradient(135deg, #ffb433 0%, #ff9500 100%)',
      },
      boxShadow: {
        'green': '0 10px 25px -5px rgba(0, 155, 119, 0.1), 0 10px 10px -5px rgba(0, 155, 119, 0.04)',
        'orange': '0 10px 25px -5px rgba(255, 180, 51, 0.1), 0 10px 10px -5px rgba(255, 180, 51, 0.04)',
      }
    },
  },
  plugins: [],
}
