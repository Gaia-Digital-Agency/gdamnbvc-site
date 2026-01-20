/**
 * Container Plugin - modifies Tailwind’s default container.
 */
const containerStyles = ({ addComponents }) => {
    const containerBase = {
      maxWidth: '100%',
      marginLeft: 'auto',
      marginRight: 'auto',
      paddingLeft: '20px',
      paddingRight: '20px',
      '@screen lg': {
        paddingLeft: '40px',
        paddingRight: '40px'
      },
    };
  
    addComponents({
      '.p-container': {
        paddingLeft: '20px',
        paddingRight: '20px',
        '@screen lg': {
          paddingLeft: '40px',
          paddingRight: '40px',
        },
        '@screen 2xl': {
          paddingLeft: '3.125rem',
          paddingRight: '3.125rem',
        }
      },
      '.-container-mobile': {
        marginLeft: '-20px',
        marginRight: '-20px',
        '@screen lg': {
          marginLeft: '0',
          marginRight: '0'
        }
      },
      '.container-padding': {
        paddingLeft: '0',
        paddingRight: '0',
        '@screen lg': {
          paddingLeft: '40px',
          paddingRight: '40px'
        },
        '@screen 2xl': {
            paddingLeft: '3.125rem',
            paddingRight: '3.125rem',
        }
      },
      '.container-mobile': {
        paddingLeft: '20px',
        paddingRight: '20px',
        '@screen md': {
          paddingLeft: '0',
          paddingRight: '0'
        }
      },
      '.container-padding-mobile': {
        paddingLeft: '20px',
        paddingRight: '20px',
        '@screen lg': {
          paddingLeft: '40px',
          paddingRight: '40px'
        },
        '@screen 2xl': {
            paddingLeft: '3.125rem',
            paddingRight: '3.125rem',
        }
      },
      '.container': {
        ...containerBase,
        '@screen 2xl': {
          width: '100%',
          maxWidth: '1440px',
          paddingLeft: '3.125rem',
          paddingRight: '3.125rem',
        }
      },
      '.container-fluid': {
        ...containerBase,
        '@screen lg': {
          paddingLeft: '45px',
          paddingRight: '45px'
        }
      },
    });
  }
  
  /** @type {import('tailwindcss').Config} */
  module.exports = {
    content: [
      './footer.php',
      './header.php',
      './index.php',
      './single.php',
      './single-journal.php',
      './parts/**/*.php',
      './parts/*.php',
      './blocks/**/*.php',
      './src/scss/**/*.scss',
      './src/js/**/*.js',
      './template-parts/*.php',
      './includes/tinymce.php',
      './dump.html'
      // './src/js/*.js',
    ],
    safelist: [
      "container-padding-mobile",
      "md:col-start-8",
      "order-3",
      "md:order-3",
      "order-4",
      "md:order-4"
    ],
    theme: {
      container: {
        center: true,
      },
      // fontSize: {
      //   '5xl': '2.75rem'
      // },
      fontFamily: {
        sans: ['"GT America"'],
        extend: ['"GT America Extended"'],
        nunito: ['"Nunito"', 'sans-serif']
      },
      extend: {
        screens: {
            "nav": "1150px",
            '2xl': '1440px',
        },
        zIndex: {
          header: 999
        },
        colors: {
          'theme-black': '#171719',
          'theme-gray': '#F3F3F4',
          'theme-grey': '#F3F3F4',
          'theme-gray-2': '#e9e9e9',
          'theme-grey-2': '#e9e9e9',
          'theme-gray-3': '#7B7B7E',
          'theme-grey-3': '#7B7B7E',
          'theme-gray-4': '#C7C7CA',
          'theme-grey-4': '#C7C7CA',
          'theme-gray-5': '#E1E1E3',
          'theme-grey-5': '#E1E1E3',
          'theme-beige': '#CEC5BF'
        }
      },
    },
    plugins: [
      containerStyles,
    ],
    // important: true,
  }
  
  