<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FormatDatum2de extends AbstractExtension {

    private $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    public function getFilters(): array {
        return [
            new TwigFilter('locale_date', [$this, 'localeDate']),
        ];
    }

    public function getFunctions(): array {
        return [
            new TwigFunction('locale_date', [$this, 'localeDate']),
        ];
    }

    public function localeDate(string $date, $format) {
        // Formatiere Datum nur für Locale de-DE, damit Monat in Deutsch übersetzt wird
        $fmt = new \IntlDateFormatter(
            'de-DE',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::FULL,
            'Europe/Berlin',
            \IntlDateFormatter::GREGORIAN,
            $format
        );
        // String in datetime konvertieren
        $date = strtotime($date);

        return $fmt->format($date);
    }

}