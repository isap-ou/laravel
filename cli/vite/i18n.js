import {exec} from "child_process";

// Function to run an Artisan command
const runCommand = (command) => new Promise((resolve, reject) =>
    exec(command, (error, stdout, stderr) => {
        if (error) {
            return reject(error);
        }
        if (stderr) {
            return reject(stderr);
        }
        return resolve(stdout)
    })
)

export default  () => ({
    name: 'vite-i18n-plugin',
    buildStart:async () => {
        await runCommand('php artisan i18n:generate')
        await runCommand('php artisan js:page-types')
    }
})