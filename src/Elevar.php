<?php

namespace Astrogoat\Elevar;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Elevar
{
    protected \Illuminate\Support\Collection $newParameters;

    protected array $currentParameters;

    public function put(array $utmParameters): static
    {
        $this->currentParameters = session('elevar', []);
        $this->currentParameters['user_id'] = session()->getId();
        $this->newParameters = collect($utmParameters);

        $hasGclidPresent = $this->newParameters->has('gclid');
        $hasUtmParameters = $this->newParameters->contains(fn ($value, $key) => Str::startsWith($key, 'utm_'));

        if ($hasGclidPresent || $hasUtmParameters) {
            $this->clearGclid();
            $this->clearUtms();
        }

        foreach ($this->newParameters as $key => $value) {
            $this->currentParameters[$key] = $value;
        }

        session()->put('elevar', $this->currentParameters);

        return $this;
    }

    public function getSources(): array
    {
        return config('elevar.sources', []);
    }

    public function clear(): void
    {
        session()->remove('elevar');
    }

    private function clearGclid(): void
    {
        $this->currentParameters = array_filter($this->currentParameters, fn ($key) => $key !== 'gclid', ARRAY_FILTER_USE_KEY);
    }

    private function clearUtms(): void
    {
        $utmSources = array_filter($this->getSources(), function ($source) {
            return Str::startsWith($source, 'utm_');
        });

        $this->currentParameters = array_filter($this->currentParameters, fn ($key) => ! in_array($key, $utmSources), ARRAY_FILTER_USE_KEY);
    }

    public function getMatchingRequestSources(Request $request): array
    {
        if (count($request->all()) === 0) {
            return [];
        }

        return array_filter($request->all(), function ($key) {
            return in_array($key, $this->getSources());
        }, ARRAY_FILTER_USE_KEY);
    }

    public function toArray(): array
    {
        return session('elevar', []);
    }
}
