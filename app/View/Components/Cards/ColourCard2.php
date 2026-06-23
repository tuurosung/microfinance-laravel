<?php

namespace App\View\Components\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColourCard2 extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title= '',
        public string $value= '',
        public ?string $valueType = null,
        public string $icon = '',
        public string $colour = '',
    )
    {
        $this->value = $this->formatValue();
    }


    private function formatValue()
    {
        if ($this->value === '') {
            return '';
        }

        return match ($this->valueType ?? 'none') {
            'currency' => 'GHS ' . number_format($this->value, 2),
            'number' => number_format($this->value),
            default => $this->value,
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cards.colour-card2');
    }
}
