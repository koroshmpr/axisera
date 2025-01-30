// Set the Preflight flag based on the build target.
const includePreflight = 'editor' !== process.env._TW_TARGET;
const plugin = require('tailwindcss/plugin');
module.exports = {
	darkMode: 'class',
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files trigger a rebuild.
		'./theme/**/*.php',
		'./javascript/*.js'
	],
	theme: {
		// Extend the default Tailwind theme.
		extend: {
			colors: {
				primary: '#FFF783',
				secondary: '#000',
				yellow : '#FFF783',
				green : '#BDFF96',
				red : '#FF9999',
				purple : '#FFB0FB',
			},
			container: {
				center: true, // Optional: Centers the container
				screens: {
					sm: '376px', // Full width for small screens
					md: '768px', // Default medium max-width
					lg: '1024px', // Default large max-width
					xl: '1300px', // Default extra-large max-width
				},
			},
		},
	},
	corePlugins: {
		// Disable Preflight base styles in builds targeting the editor.
		preflight: includePreflight,
	},
	plugins: [
		plugin(function ({ addUtilities, theme }) {
			const colors = theme('colors');
			const strokeUtilities = Object.entries(colors).reduce((acc, [key, value]) => {
				acc[`.stroke-${key}`] = {
					WebkitTextStrokeColor: typeof value === 'string' ? value : value.DEFAULT || '#000',
					WebkitTextStrokeWidth: '1.5px',
				};
				return acc;
			}, {});

			addUtilities(strokeUtilities, ['responsive', 'hover']);
		}),
		plugin(function ({ addComponents, theme }) {
			const colors = theme('colors');
			const buttonStyles = {};

			Object.keys(colors).forEach((color) => {
				buttonStyles[`.btn-${color}`] = {
					background: `linear-gradient(to right, ${colors[color]} 50%, black 50%) left`,
					backgroundSize: '310%',
					padding: '5px 12px',
					color: theme(`colors.secondary`, '#000'), // Default fallback for `text-secondary`
					border: `2px solid black`,
					borderRadius: '12px',
					transition: 'all 0.5s ease-out',
					'&:hover': {
						color: 'white',
						backgroundPosition: 'right',
					},
				};
			});

			addComponents(buttonStyles);
		}),
		// Add Tailwind Typography (via _tw fork).
		require('@_tw/typography'),
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson'),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require('@tailwindcss/forms'),
		// require('@tailwindcss/aspect-ratio'),
		// require('@tailwindcss/container-queries'),
	],
};
