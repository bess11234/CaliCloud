import { defineConfig } from "vite";
import { resolve } from 'path'
import path from 'path'
import { glob } from 'glob'

const htmlFiles = glob.sync('src/**/*.html')

// Create entry points object for Rollup
// Create entry points for Rollup
const input = {
  main: resolve(__dirname, 'index.html') // Root index.html file
}

// Add each HTML file from src to the input
htmlFiles.forEach((file) => {
  const src = file.replace(/^src\//, '') // Keeps src folder structure
  input[src] = resolve(__dirname, file)
})

export default defineConfig({
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
        }
    }

});