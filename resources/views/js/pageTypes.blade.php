export default Object.freeze({
@foreach(\App\Enums\PageTypeEnum::cases() as $enum){{$enum->name}}: "{{$enum->value}}"@if(!$loop->last){{','}}@endif @endforeach
})