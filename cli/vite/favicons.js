import {favicons, config} from "favicons";
import path from "path";
import fs from "fs/promises";

const source = path.resolve('resources/images/favicon.png');
const dest = path.resolve('public/favicons/');
const htmlBasename = path.resolve('resources/views/favicons.blade.php');

const options = {
    // Path to the favicon image in the `public` folder.
    path: '/favicons',
    appName: ' ',
    developerName: ' ',
    developerURL: 'https://isap.dev',
    theme_color: '#1a1065',
    background_color: '#1a1065',
    background: '#1a1065',
    icons: {
        android: true, // Create Android homescreen icon. `boolean` or `{ offset, background }` or an array of sources
        appleIcon: true, // Create Apple touch icons. `boolean` or `{ offset, background }` or an array of sources
        appleStartup: true, // Create Apple startup images. `boolean` or `{ offset, background }` or an array of sources
        favicons: true, // Create regular favicons. `boolean` or `{ offset, background }` or an array of sources
        windows: true, // Create Windows 8 tile icons. `boolean` or `{ offset, background }` or an array of sources
        yandex: false, // Create Yandex browser icon. `boolean` or `{ offset, background }` or an array of sources
    }
}

const buildStart = (buildOptions, test) => new Promise(resolve => {
    favicons(source, options).then(async response => {

        await fs.mkdir(dest, {recursive: true});
        await Promise.all(
            response.images.map(
                async (image) =>
                    await fs.writeFile(path.join(dest, image.name), image.contents),
            ),
        );
        await Promise.all(
            response.files.map(
                async (file) =>
                    await fs.writeFile(path.join(dest, file.name), file.contents),
            ),
        );
        await fs.writeFile(htmlBasename, response.html.join("\n"));
        resolve(response)
    })
})

export default () => ({
    name: 'vite-favicon-plugin',
    buildStart
})