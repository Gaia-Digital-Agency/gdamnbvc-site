import { defineConfig } from 'vite'
import path from 'path'
import fs from 'fs'
import { viteStaticCopy } from 'vite-plugin-static-copy'

export const phpFileReload = () => {
    return {
        name: "php-reload",
        configureServer(server) {
            const {ws, watcher} = server
            watcher.on('change', file => {
                if (file.endsWith('.php')) {
                    ws.send({
                        type: 'full-reload'
                    })
                }
            })
        }
    }
}

export const hotModuleGenerator = () => {
    const hotFilePath = path.join(process.cwd(), 'hot')
    process.on('exit', () => {
        if (fs.existsSync(hotFilePath)) {
            fs.rmSync(hotFilePath)
        }
    })
    process.on('SIGINT', () => {process.exit()})
    process.on('SIGTERM', () => {process.exit()})
    process.on('SIGHUP', () => {process.exit()})
    // const viteHot = import.meta.hot
    return {
        name: "custom-hot-module-generator",
        
        configureServer(server) {
            server.httpServer?.once('listening', () => {
                const address = server.resolvedUrls?.local?.[0] ?? 'http://localhost:5173'
                // if (!address) return
                fs.writeFileSync(hotFilePath, address)
            });
        },
        handleHotUpdate({server}) {
            const address = server.resolvedUrls?.local?.[0]
            if (!fs.existsSync(hotFilePath)) {
                fs.writeFileSync(hotFilePath, address)
            }
        }
    }
}

export default defineConfig(({ mode }) => ({
    // root: process.cwd(),
    root: path.resolve(__dirname, 'src'),
    publicDir: true,

    build: {
        outDir: 'dist',
        emptyOutDir: true,
        manifest: true,
        minify: "esbuild",
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'src/js/app.js'),
                editor: path.resolve(__dirname, 'src/js/editor.js')
            },
            external: ['jquery'],
            output: {
                globals: {
                    jquery: 'jQuery'
                }
            }
        }
    },

    css: {
        postcss: {
            plugins: [
                require('tailwindcss'),
                require('autoprefixer')
            ]
        },
    },

    plugins: [
        viteStaticCopy({
            targets: [
                { src: 'images', dest: '' },
                { src: 'fonts', dest: '' }
            ]
        }),
        hotModuleGenerator(),
        phpFileReload()
    ],

    server: {
        hmr: true,
        proxy: {
            '^/(?!@vite|src|js|css|scss|@fs|assets|dist|images)': {
                target: `http://${process.env.BASE_URL || 'localhost'}`,
                changeOrigin: true,
                secure: false
            },
        },
        watch: {
            ignored: ['**/node_modules/**'],
            interval: 200,
            atomic: true,
        },
        allowedHosts: ['0.0.0.0'],
        // open: true
    },

    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'src')
        }
    }
}))
