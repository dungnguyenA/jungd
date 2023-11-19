<?php

use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

function uploadFile($nameFolder, $files)
{
    $imagesData = [];

    foreach ($files as $file) {
        if ($file instanceof UploadedFile && $file->isValid()) {
            // Tạo tên mới cho tệp hình ảnh bằng UUID và tên gốc của tệp
            $fileName = Uuid::uuid4()->toString() . '_' . $file->getClientOriginalName();
            // Lưu tệp vào thư mục và nhận đường dẫn tệp đã lưu
            $imagePath = $file->storeAs($nameFolder, $fileName, 'public');
            // Thêm thông tin về tệp vào mảng $imagesData
            $imagesData[] = ['image_name' => $imagePath];
        }
    }


    return $imagesData;
}

function search($model, $searchTerm, $fields)
{
    $query = $model::query();

    foreach ($fields as $field) {
        $query->orWhere($field, 'like', '%' . $searchTerm . '%');
    }

    return $query->get();
}
