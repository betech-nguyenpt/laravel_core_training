<?php

use Illuminate\Database\Seeder;
use Modules\Admin\Entities\AdminAddressStreet;

class AdminAddressStreetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminAddressStreet::truncate();
        $data = [
            ['id' => '1','city_id' => '1','name' => 'Cô Bắc','short_name' => 'co bac','slug' => 'co-bac','code_no' => '26734',],
            ['id' => '2','city_id' => '1','name' => 'Cô Giang','short_name' => 'co giang','slug' => 'co-giang','code_no' => '26737',],
            ['id' => '3','city_id' => '1','name' => 'Cống Quỳnh','short_name' => 'cong quynh','slug' => 'cong-quynh','code_no' => '26740',],
            ['id' => '4','city_id' => '1','name' => 'Điện Biên Phủ','short_name' => 'dien bien phu','slug' => 'dien-bien-phu','code_no' => '26743',],
            ['id' => '5','city_id' => '1','name' => 'Đinh Tiên Hoàng','short_name' => 'dinh tien hoang','slug' => 'dinh-tien-hoang','code_no' => '26746',],
            ['id' => '6','city_id' => '1','name' => 'Đỗ Quang Đẩu','short_name' => 'do quang dau','slug' => 'do-quang-dau','code_no' => '26749',],
            ['id' => '7','city_id' => '1','name' => 'Hai Bà Trưng','short_name' => 'hai ba trung','slug' => 'hai-ba-trung','code_no' => '26752',],
            ['id' => '8','city_id' => '1','name' => 'Hàm Nghi','short_name' => 'ham nghi','slug' => 'ham-nghi','code_no' => '26755',],
            ['id' => '9','city_id' => '1','name' => 'Hồ Hảo Hớn','short_name' => 'ho hao hon','slug' => 'ho-hao-hon','code_no' => '26758',],
            ['id' => '10','city_id' => '1','name' => 'Hoàng Sa','short_name' => 'hoang sa','slug' => 'hoang-sa','code_no' => '26761',],
            ['id' => '11','city_id' => '1','name' => 'Lê Duẩn','short_name' => 'le duan','slug' => 'le-duan','code_no' => '27088',],
            ['id' => '12','city_id' => '1','name' => 'Lê Thánh Tôn','short_name' => 'le thanh ton','slug' => 'le-thanh-ton','code_no' => '27091',],
            ['id' => '13','city_id' => '1','name' => 'Lê Thị Riêng','short_name' => 'le thi rieng','slug' => 'le-thi-rieng','code_no' => '27094',],
            ['id' => '14','city_id' => '1','name' => 'Lý Tự Trọng','short_name' => 'ly tu trong','slug' => 'ly-tu-trong','code_no' => '27097',],
            ['id' => '15','city_id' => '1','name' => 'Mạc Đĩnh Chi','short_name' => 'mac dinh chi','slug' => 'mac-dinh-chi','code_no' => '27100',],
            ['id' => '16','city_id' => '1','name' => 'Nam Kỳ Khởi Nghĩa','short_name' => 'nam ky khoi nghia','slug' => 'nam-ky-khoi-nghia','code_no' => '27103',],
            ['id' => '17','city_id' => '1','name' => 'Nguyễn Bỉnh Khiêm','short_name' => 'nguyen binh khiem','slug' => 'nguyen-binh-khiem','code_no' => '27106',],
            ['id' => '18','city_id' => '1','name' => 'Nguyễn Cảnh Chân','short_name' => 'nguyen canh chan','slug' => 'nguyen-canh-chan','code_no' => '27109',],
            ['id' => '19','city_id' => '1','name' => 'Nguyễn Cư Trinh','short_name' => 'nguyen cu trinh','slug' => 'nguyen-cu-trinh','code_no' => '27112',],
            ['id' => '20','city_id' => '1','name' => 'Nguyễn Đình Chiểu','short_name' => 'nguyen dinh chieu','slug' => 'nguyen-dinh-chieu','code_no' => '27115',],
            ['id' => '21','city_id' => '1','name' => 'Nguyễn Du','short_name' => 'nguyen du','slug' => 'nguyen-du','code_no' => '27118',],
            ['id' => '22','city_id' => '1','name' => 'Nguyễn Huệ','short_name' => 'nguyen hue','slug' => 'nguyen-hue','code_no' => '27121',],
            ['id' => '23','city_id' => '1','name' => 'Nguyễn Hữu Cầu','short_name' => 'nguyen huu cau','slug' => 'nguyen-huu-cau','code_no' => '27124',],
            ['id' => '24','city_id' => '1','name' => 'Nguyễn Phi Khanh','short_name' => 'nguyen phi khanh','slug' => 'nguyen-phi-khanh','code_no' => '27127',],
            ['id' => '25','city_id' => '1','name' => 'Nguyễn Siêu','short_name' => 'nguyen sieu','slug' => 'nguyen-sieu','code_no' => '27130',],
            ['id' => '26','city_id' => '1','name' => 'Nguyễn Thái Bình','short_name' => 'nguyen thai binh','slug' => 'nguyen-thai-binh','code_no' => '27133',],
            ['id' => '27','city_id' => '1','name' => 'Nguyễn Thái Học','short_name' => 'nguyen thai hoc','slug' => 'nguyen-thai-hoc','code_no' => '27136',],
            ['id' => '28','city_id' => '1','name' => 'Nguyễn Thị Minh Khai','short_name' => 'nguyen thi minh khai','slug' => 'nguyen-thi-minh-khai','code_no' => '27139',],
            ['id' => '29','city_id' => '1','name' => 'Nguyễn Trãi','short_name' => 'nguyen trai','slug' => 'nguyen-trai','code_no' => '27142',],
            ['id' => '30','city_id' => '1','name' => 'Nguyễn Văn Cừ','short_name' => 'nguyen van cu','slug' => 'nguyen-van-cu','code_no' => '27145',],
            ['id' => '31','city_id' => '1','name' => 'Nguyễn Văn Nguyễn','short_name' => 'nguyen van nguyen','slug' => 'nguyen-van-nguyen','code_no' => '27148',],
            ['id' => '32','city_id' => '1','name' => 'Nguyễn Văn Thủ','short_name' => 'nguyen van thu','slug' => 'nguyen-van-thu','code_no' => '27151',],
            ['id' => '33','city_id' => '1','name' => 'Pasteur','short_name' => 'pasteur','slug' => 'pasteur','code_no' => '27154',],
            ['id' => '34','city_id' => '1','name' => 'Phạm Ngũ Lão','short_name' => 'pham ngu lao','slug' => 'pham-ngu-lao','code_no' => '27157',],
            ['id' => '35','city_id' => '1','name' => 'Phó Đức Chính','short_name' => 'pho duc chinh','slug' => 'pho-duc-chinh','code_no' => '27160',],
            ['id' => '36','city_id' => '1','name' => 'Tôn Đức Thắng','short_name' => 'ton duc thang','slug' => 'ton-duc-thang','code_no' => '27256',],
            ['id' => '37','city_id' => '1','name' => 'Trần Đình Xu','short_name' => 'tran dinh xu','slug' => 'tran-dinh-xu','code_no' => '27259',],
            ['id' => '38','city_id' => '1','name' => 'Trần Hưng Đạo','short_name' => 'tran hung dao','slug' => 'tran-hung-dao','code_no' => '27262',],
            ['id' => '39','city_id' => '1','name' => 'Trần Khắc Chân','short_name' => 'tran khac chan','slug' => 'tran-khac-chan','code_no' => '27265',],
            ['id' => '40','city_id' => '1','name' => 'Trần Khánh Dư','short_name' => 'tran khanh du','slug' => 'tran-khanh-du','code_no' => '27268',],
            ['id' => '41','city_id' => '1','name' => 'Trần Nhật Duật','short_name' => 'tran nhat duat','slug' => 'tran-nhat-duat','code_no' => '27271',],
            ['id' => '42','city_id' => '1','name' => 'Trần Quang Khải','short_name' => 'tran quang khai','slug' => 'tran-quang-khai','code_no' => '27274',],
            ['id' => '43','city_id' => '1','name' => 'Trương Định','short_name' => 'truong dinh','slug' => 'truong-dinh','code_no' => '27277',],
            ['id' => '44','city_id' => '1','name' => 'Võ Thị Sáu','short_name' => 'vo thi sau','slug' => 'vo-thi-sau','code_no' => '27280',],
            ['id' => '45','city_id' => '1','name' => 'Bùi Viện','short_name' => 'bui vien','slug' => 'bui-vien','code_no' => '27283',],
             
        ];
        AdminAddressStreet::insert($data);
    }
}
