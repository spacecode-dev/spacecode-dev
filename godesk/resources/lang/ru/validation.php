<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят.',
    'active_url' => ':attribute не является допустимой ссылкой.',
    'after' => ':attribute должен быть датой после :date.',
    'after_or_equal' => ':attribute должен быть датой после или равно :date.',
    'alpha' => ':attribute может содержать только буквы.',
    'alpha_dash' => ':attribute может содержать только буквы, числа, дефисы и символы подчеркивания.',
    'alpha_num' => ':attribute может содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равно :date.',
    'between' => [
        'numeric' => ':attribute должен находиться в диапазоне от :min до :max.',
        'file' => ':attribute должен находиться в диапазоне от :min и до :max килобайт.',
        'string' => ':attribute должен находиться в диапазоне от :min и до :max символов.',
        'array' => ':attribute должен находиться в диапазоне от :min и до :max элементов.',
    ],
    'boolean' => ':attribute должен быть истинным или ложным значением.',
    'confirmed' => 'Подтверждение :attribute не совпадает.',
    'date' => ':attribute не является действительной датой.',
    'date_equals' => ':attribute должен быть датой :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'different' => ':attribute и :other должны быть разными.',
    'digits' => ':attribute должен быть числом :digits.',
    'digits_between' => ':attribute должен быть в диапазоне от :min и до :max чисел.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute имеет повторяющееся значение.',
    'email' => ':attribute должен быть действительным электронным адресом.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих значений: :values.',
    'exists' => 'Выбранный :attribute является недействительным.',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute должен иметь значение.',
    'gt' => [
        'numeric' => ':attribute должен быть больше чем :value.',
        'file' => ':attribute должен быть больше чем :value килобайт.',
        'string' => ':attribute должен быть больше чем :value символов.',
        'array' => ':attribute должен иметь больше чем :value элементов.',
    ],
    'gte' => [
        'numeric' => ':attribute должен быть больше или равно :value.',
        'file' => ':attribute должен быть больше или равно :value килобайт.',
        'string' => ':attribute должен быть больше или равно :value символов.',
        'array' => ':attribute должен иметь :value элементов или больше.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный :attribute является недействительным.',
    'in_array' => ':attribute не присутствует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть действительным IP адресом.',
    'ipv4' => ':attribute должен быть действительным IPv4 адресом.',
    'ipv6' => ':attribute должен быть действительным IPv6 адресом.',
    'json' => ':attribute должен быть действительной JSON строкой.',
    'lt' => [
        'numeric' => ':attribute должен быть меньше чем :value.',
        'file' => ':attribute должен быть меньше чем :value килобайт.',
        'string' => ':attribute должен быть меньше чем :value символов.',
        'array' => ':attribute должен быть меньше чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должен быть меньше или равно :value.',
        'file' => ':attribute должен быть меньше или равно :value килобайт.',
        'string' => ':attribute должен быть меньше или равно :value символов.',
        'array' => ':attribute должен быть меньше или равно :value элементов.',
    ],
    'max' => [
        'numeric' => ':attribute не может быть больше чем :max.',
        'file' => ':attribute не может быть больше чем :max килобайт.',
        'string' => ':attribute не может быть больше чем :max символов.',
        'array' => ':attribute не может быть больше чем :max элементов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'numeric' => ':attribute должен быть не менее :min.',
        'file' => ':attribute должен быть не менее :min килобайт.',
        'string' => ':attribute должен быть не менее :min символов.',
        'array' => ':attribute должен быть не менее :min элементов.',
    ],
    'not_in' => 'Выбранный :attribute является недействительным.',
    'not_regex' => 'Формат :attribute является недействительным.',
    'numeric' => ':attribute должен быть числом.',
    'password' => 'Неверный пароль.',
    'present' => ':attribute должен присутствовать.',
    'regex' => 'Формат :attribute является недействительным.',
    'required' => ':attribute является обязательным.',
    'required_if' => ':attribute является обязательным когда :other - :value.',
    'required_unless' => ':attribute является обязательным если только :other находится в :values.',
    'required_with' => ':attribute является обязательным когда присутствует :values.',
    'required_with_all' => ':attribute является обязательным когда присутствуют :values.',
    'required_without' => ':attribute является обязательным когда не присутствует :values.',
    'required_without_all' => ':attribute является обязательным когда ни один из :values не присутствуют.',
    'same' => ':attribute и :other должны совпадать.',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть :size килобайт.',
        'string' => ':attribute должен быть :size символов.',
        'array' => ':attribute должен содержать :size элементов.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих значений: :values.',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть действующей зоной.',
    'unique' => ':attribute уже существует.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => 'Формат :attribute является недействительным.',
    'uuid' => ':attribute должен быть действующим UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
