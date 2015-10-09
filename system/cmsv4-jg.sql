CREATE TABLE `sys_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID,绑定具体站点',
  `code` varchar(50) NOT NULL COMMENT '节点名称代号(暂时没用)',
  `name` varchar(32) NOT NULL COMMENT '节点名称(用于方便查看)',
  `type` varchar(50) NOT NULL COMMENT '类型：normal,article',
  `client` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PC页面 2:手机',
  `parent_id` int(11) NOT NULL COMMENT '父节点ID',
  `filedir` varchar(255) NOT NULL COMMENT '节点目录',
  `filename` varchar(36) NOT NULL COMMENT '节点文件名',
  `url` varchar(255) NOT NULL COMMENT '节点Url(不带域名)',
  `content_group_ids` varchar(200) DEFAULT NULL COMMENT '本节点使用的内容组 用英文逗号分割',
  `tpl_type` varchar(255) DEFAULT NULL COMMENT '节点的类型',
  `tpl_url` varchar(255) DEFAULT NULL COMMENT '节点使用的模版',
  `others` longtext NOT NULL COMMENT 'JSSO数组设置',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='页面节点表'

CREATE TABLE `sys_content_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '内容分组ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID同一站点下的group-code不允许相同',
  `code` varchar(100) NOT NULL COMMENT '代号-提供给模版使用',
  `title` varchar(255) NOT NULL COMMENT '分组标题说明',
  `type` varchar(100) DEFAULT 'article' COMMENT '分组类型：normal article photo ',
  `c_date` datetime NOT NULL COMMENT '分组创建时间',
  `u_date` datetime NOT NULL COMMENT '分组更新时间',
  `osort` int(11) NOT NULL COMMENT '排序字段-保留字段',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态1正常-保留字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='内容表'

CREATE TABLE `sys_content_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `content_group_id` int(11) NOT NULL COMMENT '分组ID 默认0不加入任何分组',
  `title` varchar(255) NOT NULL COMMENT '文章主标题',
  `subtitle` varchar(255) NULL COMMENT '文章副标题',
  `img` varchar (255) NULL COMMENT '文章大图',
  `content` longtext NULL COMMENT '编辑器编辑内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT '文章表'; 

//从这里开始添加
CREATE TABLE `sys_content_seo`(

)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='SEO数据表存放结点对应'

CREATE TABLE `sys_content_global` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `code` varchar(50) NOT NULL COMMENT '代号',
  `name` varchar(255)  NOT NULL COMMENT '名称说明',
  `type` varchar(50) NOT NULL DEFAULT 'text' COMMENT '类型：text,select',
  `val` varchar(500) NULL DEFAULT '' COMMENT '数值', 
  `other` longtext DEFAULT NULL COMMENT '额外其他数据-JSON数组保存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='全站通用可编辑数据表';



CREATE TABLE `sys_album` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `code` varchar(50) NOT NULL COMMENT '代号',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='相册数据单元'; 


CREATE TABLE `sys_album_dir` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `p_id` int(11) NOT NULL DEFAULT 0 COMMENT '父目录节点',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `album_id` int(11) NOT NULL COMMENT '相册ID', 
  `title` varchar(255) NULL COMMENT '相册标题',
  `subtitle` varchar(255) NULL COMMENT '相册描述',
  `cover` varchar(255) NULL COMMENT '封面',
  `link` varchar(255) NULL COMMENT '链接',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='相册目录';  

CREATE TABLE `sys_album_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `album_dir_id` int(11) NOT NULL COMMENT '照片属于某个目录',
  `title` varchar(255) NULL COMMENT '相册标题',
  `subtitle` varchar(255) NULL COMMENT '相册描述',
  `img_pre` varchar(255) NULL COMMENT '预览图路径',
  `img` varchar(255) NULL COMMENT '正图路径', 
  `c_date` datetime NOT NULL COMMENT '创建时间', 	
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='照片表'; 

=> 新思路在这里




CREATE TABLE `sys_content_ext_model`(
  `id`
  `other` longtext DEFAULT NULL COMMENT '额外其他数据-JSON数组保存', 
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='扩展模型';

/*
CREATE TABLE `sys_content_ext`(
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `content_gather_id` int(11) NOT NULL COMMENT 'ContentID',
  `ccate` int(11) NOT NULL COMMENT '分类ID',

  `other` longtext DEFAULT NULL COMMENT '额外其他数据-JSON数组保存',  
   PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='基础内容单元';
*/
/*
CREATE TABLE `sys_content_ext`(
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `content_id` int(11) NOT NULL COMMENT 'ContentID',
  `code` varchar(50) NOT NULL COMMENT '代号(同一个contentID代号不允许重复)',
  `name` varchar(255)  NOT NULL COMMENT '名称说明',
  `ext_type` varchar(50) NOT NULL COMMENT '扩展类型:input img select',
  `ext_other` longtext DEFAULT NULL COMMENT '扩展设置:select选项等',   
  `val` varchar(500) NULL DEFAULT '' COMMENT '数值',	
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='基础内容单元扩展'; 
*/

CREATE TABLE `sys_content`(
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `ccate` int(11) NOT NULL COMMENT '分类ID',
  `ctype` varchar(255) NOT NULL COMMENT '描述分类字段，便于运营清晰看到',
  `title` varchar(255) NOT NULL COMMENT '主标题',
  `title_sub` varchar(255) NULL COMMENT '副标题',
  `img` varchar (255) NULL COMMENT '标识图',
  `ext` longtext DEFAULT NULL COMMENT '额外其他数据-JSON数组保存',  
   PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='基础内容单元';


CREATE TABLE `sys_content_gather`(
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增唯一ID',
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `code` varchar(50) NOT NULL COMMENT '代号',
  `name` varchar(255)  NOT NULL COMMENT '名称说明',
  `ext_model` varchar(50) NOT NULL DEFAULT 'text' COMMENT '扩展类型',
  `val` varchar(500) NULL DEFAULT '' COMMENT '数值',   
  `other` longtext DEFAULT NULL COMMENT '额外其他数据-JSON数组保存',
   PRIMARY KEY (`id`)
)  ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='基础内容集合';

INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='万人炸金花',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='女神斗地主',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='天天爱闯关',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='嘉米麻将',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='万人斗地主',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='吸血鬼日记',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='3D狂野飞车',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='天天美女',`title_sub` ='副标';
INSERT INTO `sys_content` SET `site_id` = 3,`tag`='推荐手游',`title` ='来自星星的僵尸',`title_sub` ='副标';

18,19,20,21,22,23,24,25,26



 





 

