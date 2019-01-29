<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                          ThinkSNS Plus                               |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2016-Present ZhiYiChuangXiang Technology Co., Ltd.     |
 * +----------------------------------------------------------------------+
 * | This source file is subject to enterprise private license, that is   |
 * | bundled with this package in the file LICENSE, and is available      |
 * | through the world-wide-web at the following url:                     |
 * | https://github.com/slimkit/plus/blob/master/LICENSE                  |
 * +----------------------------------------------------------------------+
 * | Author: Slim Kit Group <master@zhiyicx.com>                          |
 * | Homepage: www.thinksns.com                                           |
 * +----------------------------------------------------------------------+
 */

namespace Zhiyi\Component\ZhiyiPlus\PlusComponentNews\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCate extends Model
{
    protected $table = 'news_cates';
    public $timestamps = false;

    /**
     * Has news.
     *
     * @return null|
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function news()
    {
        return $this->hasMany(News::class, 'cate_id', 'id');
    }
}
