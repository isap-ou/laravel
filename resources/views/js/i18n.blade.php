import {createI18n} from "vue-i18n";
@foreach(LaravelLocalization::getSupportedLanguagesKeys() as $locale)
import {{$locale}} from './locales/{{$locale}}.js'
@endforeach

export default createI18n({
    legacy: false,
    fallbackLocale: '{{LaravelLocalization::getDefaultLocale()}}',
    missingWarn: false,
    fallbackWarn: false,
    silentTranslationWarn: true,
    messages: {@foreach(LaravelLocalization::getSupportedLanguagesKeys() as $locale){{$locale}}@if(!$loop->last){{','}}@endif @endforeach}
})