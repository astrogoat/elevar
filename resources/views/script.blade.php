@php($settings = settings(Astrogoat\Elevar\Settings\ElevarSettings::class))

@if($settings->isEnabled() && $settings->data_layer_listener_enabled)
    <!-- [ELEVAR] Start -->
    <script id="elevar-dl-listener-config" type="application/json">
        {
            "data_layer_listener_script": "https://shopify-gtm-suite.getelevar.com/shops/{{ $settings->uuid }}/3.2.10/events.js",
            "ss_url": {!! blank($settings->server_side_url) ? 'null' : '"' . $settings->server_side_url . '"' !!}
            "signing_key": {{ $settings->signing_key }},
  	        "myshopify_domain": "{{ Str::of(settings(Astrogoat\Shopify\Settings\ShopifySettings::class)->url)->replace('https://', '') }}"
        }
    </script>
    <script>
        (() => {
            if (!window.__ElevarIsGtmSuiteListenerCalled) {
                window.__ElevarIsGtmSuiteListenerCalled = true;
                const configElement = document.getElementById(
                    "elevar-dl-listener-config"
                );

                if (!configElement) {
                    console.error("Elevar: DLL Config element not found");
                    return;
                }

                const config = JSON.parse(configElement.textContent);

                const script = document.createElement("script");
                script.type = "text/javascript";
                script.src = config.data_layer_listener_script;
                script.async = false;
                script.defer = true;

                script.onerror = function () {
                    console.error("Elevar: DLL JS script failed to load");
                };
                script.onload = function () {
                    if (!window.ElevarGtmSuiteListener) {
                        console.error("Elevar: `ElevarGtmSuiteListener` is not defined");
                        return;
                    }

                    window.ElevarGtmSuiteListener.handlers.listen({
                        ssUrl: config.ss_url,
                        signingKey: config.signing_key,
                        myshopifyDomain: config.myshopify_domain
                    });
                };

                document.head.appendChild(script);
            }
        })();
    </script>
    <script id="elevar-dl-aat-config" type="application/json">
      {
        "data_layer_aat_script": "https://shopify-gtm-suite.getelevar.com/shops/{{ $settings->uuid }}/3.2.10/aat.js",
        "apex_domain": "{{ Str::of(url(''))->replace('http://', '') }}",
        "consent_enabled": false
        }
    </script>
    <script>
        (() => {
            if (!window.__ElevarIsGtmSuiteAATCalled) {
                window.__ElevarIsGtmSuiteAATCalled = true;
                const init = () => {
                    window.__ElevarDataLayerQueue = [];
                    window.__ElevarListenerLoadQueue = [];
                    if (!window.dataLayer) window.dataLayer = [];
                }
                init();
                window.__ElevarTransformItem = event => {
                    if (typeof window.ElevarTransformFn === "function") {
                        try {
                            const result = window.ElevarTransformFn(event);
                            if (typeof result === "object" && !Array.isArray(result) && result !== null) {
                                return result;
                            } else {
                                console.error("Elevar Data Layer: `window.ElevarTransformFn` returned a value " + "that wasn't an object, so we've treated things as if this " + "function wasn't defined.");
                                return event;
                            }
                        } catch (error) {
                            console.error("Elevar Data Layer: `window.ElevarTransformFn` threw an error, so " + "we've treated things as if this function wasn't defined. The " + "exact error is shown below.");
                            console.error(error);
                            return event;
                        }
                    } else {
                        return event;
                    }
                }
                window.ElevarPushToDataLayer = item => {
                    const enrichedItem = {
                        event_id: window.crypto.randomUUID ? window.crypto.randomUUID() : String(Math.random()).replace("0.", ""),
                        event_time: new Date().toISOString(),
                        ...item
                    };
                    const transformedEnrichedItem = window.__ElevarTransformItem ? window.__ElevarTransformItem(enrichedItem) : enrichedItem;
                    const listenerPayload = {
                        raw: enrichedItem,
                        transformed: transformedEnrichedItem
                    };
                    const getListenerNotifyEvent = () => {
                        return new CustomEvent("elevar-listener-notify", {
                            detail: listenerPayload
                        });
                    };
                    if (transformedEnrichedItem._elevar_internal?.isElevarContextPush) {
                        window.__ElevarIsContextSet = true;
                        window.__ElevarDataLayerQueue.unshift(transformedEnrichedItem);
                        if (window.__ElevarIsListenerListening) {
                            window.dispatchEvent(getListenerNotifyEvent());
                        } else {
                            window.__ElevarListenerLoadQueue.unshift(listenerPayload);
                        }
                    } else {
                        window.__ElevarDataLayerQueue.push(transformedEnrichedItem);
                        if (window.__ElevarIsListenerListening) {
                            window.dispatchEvent(getListenerNotifyEvent());
                        } else {
                            window.__ElevarListenerLoadQueue.push(listenerPayload);
                        }
                    }
                    if (window.__ElevarIsContextSet) {
                        while (window.__ElevarDataLayerQueue.length > 0) {
                            window.dataLayer.push(window.__ElevarDataLayerQueue.shift());
                        }
                    }
                }

                const configElement = document.getElementById("elevar-dl-aat-config");

                if (!configElement) {
                    console.error("Elevar: AAT Config element not found");
                    return;
                }

                const config = JSON.parse(configElement.textContent);

                const script = document.createElement("script");
                script.type = "text/javascript";
                script.src = config.data_layer_aat_script;
                script.async = false;
                script.defer = true;

                script.onerror = () => {
                    console.error("Elevar: AAT JS script failed to load");
                };
                script.onload = async () => {
                    if (!window.ElevarGtmSuiteAAT) {
                        console.error("Elevar: `ElevarGtmSuiteAAT` is not defined");
                        return;
                    }

                    await window.ElevarGtmSuiteAAT.handlers.register({
                        apexDomain: config.apex_domain,
                        isConsentEnabled: config.consent_enabled
                    });
                };

                document.head.appendChild(script);
            }
        })();
    </script>
    <!-- [ELEVAR] End -->
@endif
