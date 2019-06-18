

// 1.0 配置模块
require.config({
	// 1.1 声明模块
	paths: {
		"jquery": "../vendors/jquery/jquery",
		"template": "../vendors/art-template/template-web",
		"pagination": "../vendors/twbs-pagination/jquery.twbsPagination",
		"bootstrap": "../vendors/bootstrap/js/bootstrap"
	},
	// 1.2 声明模块之间的依赖关系
	shim: {
		"pagination": {
			deps: ["jquery"]
		},
		"bootstrap": {
			deps: ["jquery"]
		}
	}
})


// 2.0 引入模块 
require(["jquery", "template", "pagination", "bootstrap"], function($, template, pagination, bootstrap) {
	// 3.0 实现功能
	$(function() {
        // 声明默认数据变量
        var currentPage = 1;
        var pageSize = 10;
        var pageCount;

        // 声明对象
        var status = {
            "held": "未审核",
            "approved": "以准许",
            "rejected": "已拒绝",
            "trashed": "已删除"
        }

        // 页面一加载进来就发送请求
        getCommentsData();
        function getCommentsData() {
            $.ajax({
                type: "post",
                url: "api/_getCommentsData.php",
                data: {
                    "currentPage": currentPage,
                    "pageSize": pageSize
                },
                success: function(res) {
                    if(res.code == 1) {
                        pageCount = res.pageCount;
                        /* var html = template("tempId", res);
                          1，如果是原生的调用，就使用 template-native.js 
                          2，规定第二个参数一定要是对象
                              a, 如果返回的数据本身就是对象，那么直接放在第2个参数的位置
                              b, 如果返回的数据是一个数组，那么改写成对象 {"数组名": 数组}
                          3，如果是a, 那么对象中数组叫什么，模板就遍历什么
                             如果是b, 那么数组名叫什么，模板就遍历什么
                        */
                        res.sta = status; // 追加一个对象信息
                        // 1.0 动态渲染页面结构
                        var html = template("tempId", res);
                        /*
                          1，如果是简洁模板的调用，要区分有没有-web
                              template.js   /   template-web.js
                              template.js :遍历的时候在值得前面要加as关键字 each data as val
                              template-web.js: 遍历的时候不需要加   each data val
                          2，如果传进来的是对象，那么遍历的就是对象中的数组名
                          3，如果传进来的是数组，那么遍历的就是$data
                              注意： 严格使用 $data 关键字，和当前传进来的数组没有关系
                         */
                        $("tbody").html(html);


                        // 2.0调用分页的插件
                        $(".pagination").twbsPagination({
                            totalPages: pageCount,
                            visiblePages: 7,
                            onPageClick: function(event, page) {
                                currentPage = page;
                                getCommentsData();
                            }
                        })
                    }
                    
                }
            })
        }  
    })
})

