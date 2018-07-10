<?php

namespace Omnispear\Media\Requests;

class MediaImageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'width' => 'sometimes|numeric',
            'height' => 'sometimes|numeric',
            'type' => 'sometimes'
        ];
    }
}
