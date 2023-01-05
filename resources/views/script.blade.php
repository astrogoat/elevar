@php($settings = settings(Astrogoat\Elevar\Settings\ElevarSettings::class))

@if($settings->isEnabled() && $settings->data_layer_listener_enabled)
    <!-- [ELEVAR] Start -->
    <script id="elevar-dl-listener-config" type="application/json">
        {
            "data_layer_listener_script": "https://shopify-gtm-suite.getelevar.com/shops/{{ $settings->uuid }}/events.js",
            "ss_url": {!! blank($settings->server_side_url) ? 'null' : '"' . $settings->server_side_url . '"' !!}
        }
    </script>
    <script>
        (function () {
            const configElement = document.getElementById("elevar-dl-listener-config");

            if (!configElement) {
                console.error("Elevar Data Layer Listener: Config element not found");
                return;
            }

            const config = JSON.parse(configElement.textContent);

            const script = document.createElement("script");
            script.type = "text/javascript";
            script.src = config.data_layer_listener_script;

            script.onerror = function () {
                console.error("Elevar Data Layer Listener: JS script failed to load");
            };
            script.onload = function () {
                if (!window.ElevarGtmSuiteListener) {
                    console.error(
                        "Elevar Data Layer Listener: `ElevarGtmSuiteListener` is not defined"
                    );
                    return;
                }

                window.ElevarGtmSuiteListener.handlers.listen({ ssUrl: config.ss_url });
            };

            const headScripts = document.head.getElementsByTagName("script");

            if (headScripts[0]) {
                document.head.insertBefore(script, headScripts[0]);
            } else {
                document.head.appendChild(script);
            }
        })();
    </script>
    <!-- [ELEVAR] End -->
@endif
