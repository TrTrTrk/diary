<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

use function PHPUnit\Framework\isNull;

class TextRequired implements ValidationRule, DataAwareRule
{
    /**
     * バリデーション下の全データ
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * バリデーション下のデータをセット
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!array_key_exists('checkboxes', $this->data)) {
            return;
        }

        //文章が全く入力されていない場合
        if (count(array_filter($value)) == 0) { 
            $fail("文章を入力してください。");
            return;
        }

        foreach ($this->data['checkboxes'] as $value) {
            if (is_null($this->data['texts'][$value])) {
                $Row = $value + 1;
                $fail("文章が無い行がチェックされています。". $Row . "行目。");
            }
        }
    }
}
