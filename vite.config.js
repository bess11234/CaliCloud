import { defineConfig } from "vite";
import { resolve } from 'path'
import path from 'path'
import { glob } from 'glob'
import dotenv from 'dotenv';

const htmlFiles = glob.sync('page/**/*.html')

// Create entry points object for Rollup
// Create entry points for Rollup
const input = {
    main: resolve(__dirname, 'index.html') // Root index.html file
}

// Add each HTML file from src to the input
htmlFiles.forEach((file) => {
    const page = file.replace(/^page\//, '') // Keeps src folder structure
    input[page] = resolve(__dirname, file)
})

dotenv.config();

export default defineConfig({
    base: './',
    root: './',
    build: {
        rollupOptions: {
            input: input
        },
        outDir: './dist',
        emptyOutDir: true, // also necessary
    },
    server: {
        port: 3000,
        host: true,
        strictPort: true,   // Fail if port 8083 is not available
        watch: {
            usePolling: true  // Useful if you're running in environments like Docker or cloud VMs
        },
        proxy: {
            '/backend': {
                target: 'http://localhost:8000', // Your PHP server URL
                changeOrigin: true,
            }
        },
        hmr: {
            overlay: false,
        }
    },
    define: {
        'process.env': process.env
    },

});
