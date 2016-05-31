<?php
/**
 * User: loveyu
 * Date: 2016/6/1
 * Time: 4:33
 */

namespace ULib;


/**
 * 全文索引数据转换为要显示的数据
 * Class FulltextDataConvert
 * @package ULib
 */
class FulltextDataConvert{

	/**
	 * 转换为图片要显示的数据
	 * @param array $list
	 * @return array
	 */
	public function toPic(array $list){
		if(empty($list)){
			return [];
		}
		$ids = array_keys($list);
		$pic_obj = new Picture();
		$rt = array_fill_keys($ids, NULL);
		$pic_list = $pic_obj->get_simple_pic($ids, true);
		foreach($pic_list as $v){
			$v = ArrayUtil::get_map_kv($v, [
				'pic_id',
				'pic_link',
				'pic_name',
				'pic_thumbnails_url' => "img_url"
			]);
			$rt[$v['pic_id']] = $v;
		}
		return array_values(array_filter($rt));
	}

	/**
	 * 转换为图集要显示的数据
	 * @param array $list
	 * @return array
	 */
	public function toGallery(array $list){
		if(empty($list)){
			return [];
		}
		$list_obj = new ListGallery();
		$result = $list_obj->getListByGalleryIds(array_keys($list));
		$result = ArrayUtil::rebuild_list_map_kv($result, array(
			'gallery_id',
			'gallery_title',
			'pic_thumbnails_url' => 'cover_img'
		));
		foreach($result as &$item){
			$item['gallery_link'] = gallery_link($item['gallery_id']);
		}
		return $result;
	}

	/**
	 * 转换为文章要显示的数据
	 * @param array $list
	 * @return array
	 */
	public function toPost(array $list){
		if(empty($list)){
			return [];
		}
	}

}