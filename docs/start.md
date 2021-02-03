## 开始须知

!> 很多人使用主题可能都会出现这样的报错

```php
syntax error, unexpected 'endwhile' (T_ENDWHILE), expecting elseif (T_ELSEIF) or else (T_ELSE) or endif (T_ENDIF) 
```

?> 那是因为你使用的`php`环境没有开启短代码标记

?> `2.2.4` 版本已经彻底移除它的问题
> 这里推荐不是推销，使用宝塔`PHP`，安装到家

或者你讨厌使用它，或是使用docker，自行修改`php.ini`，搜索`short_open_tag = Off` 改成 `On` 就行了。

因为非常重要，特地放在开头，希望大家能够引起大家的重视。

`2.2.3`已修复，可以不用开启短代码了
---

### 下载

#### [下载最新Release版本](https://github.com/dyedd/lanstar/releases/latest)

> 最新的发布版本，适合绝大多数用户。

##### [下载其它版本](https://github.com/dyedd/lanstar)

> 因为有时候是推送的功能是最新的，却没有打包，你可以直接通过code按钮的Download ZIP
>
> 当然你想使用老版本或者其它，可以选择tags选择自己想要的版本标签，或者点击Releases，滚动你的浏览器查找自己喜欢的版本。

---

### 安装

1. 如果不知道安装在什么目录，那么建议通过和本文档达成战略协议的百度Or谷歌搜索~
2. 上传解压到文件夹，重命名为`lanstar`
   1. <u>注意此文件夹下即可访问`index.php`等资源文件，而非`lanstar/lanstar`形式</u>

