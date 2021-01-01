### 如何添加导航小图标？

自2.2.0新版本以来，转移`bootstrap icon`至`iconfont`

#### 采用平台推荐的<u>未来主流symbol引用</u>

- 支持多色图标了，不再受单色限制。
- 通过一些技巧，支持像字体那样，通过`font-size`,`color`来调整样式。
- 兼容性较差，支持 ie9+,及现代浏览器。
- 浏览器渲染svg的性能一般，还不如png。

!> 主题使用的图标都写到了`assets/js/icon.js`下

大家可以通过此链接预览[iconfont预览工具](http://blog.luckly-mjw.cn/tool-show/iconfont-preview/index.html)

?> 然后可以复制名称icon-xxx，到后台，一个按顺序对应一行

### 那么我可以添加自己的图标吗？

当然可以，你只需要在iconfont创建项目，注意：

![image-20210101170507643](https://i.loli.net/2021/01/01/sUH2yWdJAkIPZx4.png)

不变，然后复制你项目的js链接到component文件夹的`index.footer.php`，**建议直接添加在最后一行**，

```js
<script src=""></script>
```

---



2.2.0以前版本：

进入网址https://icons.getbootstrap.com/

寻找心爱的图标

![方法](https://i.loli.net/2021/01/01/6sapt1CkUX5FoAJ.png)

如上图所示，取```alarm-fill```

然后再填到后台模板设置