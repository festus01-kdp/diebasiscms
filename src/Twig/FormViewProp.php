<?php

namespace App\Twig;

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FormViewProp extends AbstractExtension {

    private $requestStack;

    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    public function getFilters(): array {
        return [
            new TwigFilter('formview_prop', array($this, 'getFormViewProperty')),
        ];
    }

    public function getFunctions(): array {
        return [
            new TwigFunction('formview_prop', [$this, 'getFormViewProperty']),
        ];
    }

    public function getFormViewProperty(FormView $formView, string $prop) {
        return $formView->{$prop};
    }


}