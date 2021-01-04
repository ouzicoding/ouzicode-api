<footer id="footer" v-cloak>
    <p class="links">友情链接：
        <a :href="link.link_url" v-for="link in footer.links" target="_blank">@{{ link.link_name }}</a>
    </p>
    <p class="copyright">
        <span>© 2020 ouzicode.com版权所有 </span>
        ICP证：<a href="http://www.beian.miit.gov.cn" target="_blank" >豫ICP备20016154号-1</a>
    </p>
    {{--<p>联系邮箱：ouzi@ouzicode.com</p>--}}
</footer>
