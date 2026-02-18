@isset($pageConfigs)
    {!! \App\Helpers\Helpers::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = \App\Helpers\Helpers::appClasses();
@endphp

@isset($configData['layout'])
    @include(
        $configData['layout'] === 'horizontal'
            ? 'admin.layouts.horizontalLayout'
            : ($configData['layout'] === 'blank'
                ? 'admin.layouts.blankLayout'
                : 'admin.layouts.contentNavbarLayout'))
@endisset
