@php($settings = settings(Astrogoat\Elevar\Settings\ElevarSettings::class))

@if($settings->isEnabled())
    <!-- [ELEVAR] Start -->
    <script type="module">
        try {
            const settings = {};
            const config = (await import("https://shopify-gtm-suite.getelevar.com/configs/{{ $settings->uuid }}/config.js")).default;
            const scriptUrl = settings.proxyPath
                ? `${settings.proxyPath}${config.script_src_custom_pages_proxied}`
                : config.script_src_custom_pages;

            if (scriptUrl) {
                const { handler } = await import(scriptUrl);
                await handler(config, settings);
            }
        } catch (error) {
            console.error("Elevar Error:", error);
        }
    </script>
    <!-- [ELEVAR] End -->
@endif
