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

    'accepted' => ':attribute повинен бути прийнятий.',
    'active_url' => ':attribute не є допустимим посиланням.',
    'after' => ':attribute повинен бути датою після :date.',
    'after_or_equal' => ':attribute повинен бути датою після або дорівнювати :date.',
    'alpha' => ':attribute може містити тільки літери.',
    'alpha_dash' => ':attribute може містити тільки літери, числа, дефісы и символи підкреслення.',
    'alpha_num' => ':attribute може містити тільки літери и цифры.',
    'array' => ':attribute повинен бути массивом.',
    'before' => ':attribute повинен бути датою до :date.',
    'before_or_equal' => ':attribute повинен бути датою до або дорівнювати :date.',
    'between' => [
        'numeric' => ':attribute повинен перебувати в діапазоні від :min до :max.',
        'file' => ':attribute повинен перебувати в діапазоні від :min та до :max кілобайтів.',
        'string' => ':attribute повинен перебувати в діапазоні від :min та до :max символів.',
        'array' => ':attribute повинен перебувати в діапазоні від :min та до :max елементів.',
    ],
    'boolean' => ':attribute повинен бути істинним або хибним значенням.',
    'confirmed' => 'Підтвердження :attribute не співпадають.',
    'date' => ':attribute не є дійсною датою.',
    'date_equals' => ':attribute повинен бути датою :date.',
    'date_format' => ':attribute не відповідає формату :format.',
    'different' => ':attribute та :other повинні бути різними.',
    'digits' => ':attribute повинен бути числом :digits.',
    'digits_between' => ':attribute повинен бути в діапазоні від :min та до :max чисел.',
    'dimensions' => ':attribute має неприпустимі розміри зображення.',
    'distinct' => ':attribute має повторюване значення.',
    'email' => ':attribute повинен бути дійсною електронною адресою.',
    'ends_with' => ':attribute повинен закінчуватися одним з наступних значень: :values.',
    'exists' => 'Вибраний :attribute є недійсним.',
    'file' => ':attribute повинен бути файлом.',
    'filled' => ':attribute повинен мати значення.',
    'gt' => [
        'numeric' => ':attribute повинен бути більше ніж :value.',
        'file' => ':attribute повинен бути більше ніж :value кілобайтів.',
        'string' => ':attribute повинен бути більше ніж :value символів.',
        'array' => ':attribute повинен мати більше ніж :value елементів.',
    ],
    'gte' => [
        'numeric' => ':attribute повинен бути більше або дорівнювати :value.',
        'file' => ':attribute повинен бути більше або дорівнювати :value кілобайтів.',
        'string' => ':attribute повинен бути більше або дорівнювати :value символів.',
        'array' => ':attribute повинен мати :value елементів або більше.',
    ],
    'image' => ':attribute повинен бути зображенням.',
    'in' => 'Вибраний :attribute є недійсним.',
    'in_array' => ':attribute не присутній в :other.',
    'integer' => ':attribute повинен бути цілим числом.',
    'ip' => ':attribute повинен бути дійсною IP адресою.',
    'ipv4' => ':attribute повинен бути дійсною IPv4 адресою.',
    'ipv6' => ':attribute повинен бути дійсною IPv6 адресою.',
    'json' => ':attribute повинен бути дійсною JSON строкою.',
    'lt' => [
        'numeric' => ':attribute повинен бути менше ніж :value.',
        'file' => ':attribute повинен бути менше ніж :value кілобайтів.',
        'string' => ':attribute повинен бути менше ніж :value символів.',
        'array' => ':attribute повинен бути менше ніж :value елементів.',
    ],
    'lte' => [
        'numeric' => ':attribute повинен бути менше або дорівнювати :value.',
        'file' => ':attribute повинен бути менше або дорівнювати :value кілобайтів.',
        'string' => ':attribute повинен бути менше або дорівнювати :value символів.',
        'array' => ':attribute повинен бути менше або дорівнювати :value елементів.',
    ],
    'max' => [
        'numeric' => ':attribute не може бути більше ніж :max.',
        'file' => ':attribute не може бути більше ніж :max кілобайтів.',
        'string' => ':attribute не може бути більше ніж :max символів.',
        'array' => ':attribute не може бути більше ніж :max елементів.',
    ],
    'mimes' => ':attribute повинен бути файлом типу: :values.',
    'mimetypes' => ':attribute повинен бути файлом типу: :values.',
    'min' => [
        'numeric' => ':attribute повинен бути не менше :min.',
        'file' => ':attribute повинен бути не менше :min кілобайтів.',
        'string' => ':attribute повинен бути не менше :min символів.',
        'array' => ':attribute повинен бути не менше :min елементів.',
    ],
    'not_in' => 'Вибраний :attribute є недійсним.',
    'not_regex' => 'Формат :attribute є недійсним.',
    'numeric' => ':attribute повинен бути числом.',
    'password' => 'Невірний пароль.',
    'present' => ':attribute повинен бути присутній.',
    'regex' => 'Формат :attribute є недійсним.',
    'required' => ':attribute є обов\'язковим.',
    'required_if' => ':attribute є обов\'язковим коли :other - :value.',
    'required_unless' => ':attribute є обов\'язковим якщо тільки :other знаходиться в :values.',
    'required_with' => ':attribute є обов\'язковим коли присутній :values.',
    'required_with_all' => ':attribute є обов\'язковим коли присутні :values.',
    'required_without' => ':attribute є обов\'язковим коли не присутній :values.',
    'required_without_all' => ':attribute є обов\'язковим коли не один з :values не присутні.',
    'same' => ':attribute та :other повинні співпадати.',
    'size' => [
        'numeric' => ':attribute повинен бути :size.',
        'file' => ':attribute повинен бути :size кілобайтів.',
        'string' => ':attribute повинен бути :size символів.',
        'array' => ':attribute повинен містити :size елементів.',
    ],
    'starts_with' => ':attribute повинен починатися з одного з наступних значень: :values.',
    'string' => ':attribute повинен бути строкой.',
    'timezone' => ':attribute повинен бути діючої зоною.',
    'unique' => ':attribute вже існує.',
    'uploaded' => ':attribute не вдалося завантажити.',
    'url' => 'Формат :attribute є недійсним.',
    'uuid' => ':attribute повинен бути дійсним UUID.',

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
