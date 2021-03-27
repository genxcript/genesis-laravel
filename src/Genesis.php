<?php

namespace LaravelGenesis\Genesis;

use Livewire\Livewire;
use LaravelGenesis\Genesis\Http\Livewire\Form;

class Genesis
{
    public function mountForm(string $component, $params = [])
    {
        if (! new $component instanceof Form) {
            throw new \Exception('You need to pass an instance of LaravelGenesis\Genesis\Http\Livewire\Form');
        }

        return  Livewire::mount($component, $params)->effects['html'];
    }

    public function styles($options = [])
    {
        $debug = config('app.debug');

        $styles = $this->cssAssets();

        // HTML Label.
        $html = $debug ? ['<!-- Genesis Styles -->'] : [];

        // CSS assets.
        $html[] = $debug ? $styles : $this->minify($styles);

        return implode("\n", $html);
    }

    public function scripts($options = [])
    {
        $debug = config('app.debug');

        $scripts = $this->javaScriptAssets($options);

        // HTML Label.
        $html = $debug ? ['<!-- Genesis Scripts -->'] : [];

        // JavaScript assets.
        $html[] = $debug ? $scripts : $this->minify($scripts);

        return implode("\n", $html);
    }

    protected function cssAssets()
    {
        $pikaday = config('genesis.load_pikaday') ? '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">' : '';
        $trix = config('genesis.load_trix') ? '<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">' : '';

        return <<<HTML
    $pikaday
    $trix
<style>
    /** Genesis custom style */
</style>
HTML;
    }

    protected function javaScriptAssets($options)
    {
        $moment = config('genesis.load_momentjs') ? '<script src="https://unpkg.com/moment"></script>' : '';
        $pikaday = config('genesis.load_pikaday') ? '<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>' : '';
        $trix = config('genesis.load_trix') ? '<script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>' : '';

        $notifications = file_get_contents(__DIR__.'/../resources/views/components/notification.blade.php');

        return <<<HTML
    $notifications
    $moment
    $pikaday
    $trix
<!-- <script data-turbolinks-eval="false">
    document.addEventListener("DOMContentLoaded", function () {

    });
</script> -->
HTML;
    }

    protected function minify($subject)
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}
