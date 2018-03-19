一个基于laravel5.6的内容管理系统。

<h2>感谢</h2>
本项目基于或依赖于以下组件或项目：
<p><a href="https://github.com/laravel/laravel">laravel</a></p>
<p><a href="https://github.com/overtrue/laravel-lang">overtrue/laravel-lang</a></p>
<p><a href="https://github.com/laracasts/flash">laracasts/flash</a></p>
<p><a href="https://github.com/NauxLiu/Laravel-SendCloud">NauxLiu/Laravel-SendCloud</a></p>
<p><a href="https://github.com/overtrue/laravel-ueditor">overtrue/laravel-ueditor</a></p>
<p><a href="https://github.com/select2/select2">select2/select2</a></p>
<p><a href="https://github.com/z-song/laravel-admin">Laravel-admin</a></p>

<h2>安装项目</h2>
1,克隆项目到本地
<br>
`git clone -b master https://github.com/ihavenodream/laravel.git`
<br>
2，配置运行环境,windows建议使用<a href="https://laragon.org/">laragon</a>集成环境，linux正常配置即可
<table>
   <tr>
        <th></th>
        <th>PHP</th>
        <th>Mysql</th>
        <th>Node.js</th>
   </tr>
   <tr>
        <th>Version</th>
        <th>>=7.1</th>
        <th>>=5.6</th>
        <th>>=9.6</th>
   </tr>
</table>

3，安装相关依赖
<br>
PHP依赖
<br>
`composer install`
<br>
Node.js依赖
<br>
`npm install`
<br>
4，进行数据表迁移和数据填充
<br>
`php artisan migrate`
<br>