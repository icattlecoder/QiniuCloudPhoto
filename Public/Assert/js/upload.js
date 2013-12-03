//“显示文件信息”按钮的click事件代码
$(function() {
    var Bucket = "qtestbucket";
    Q.Histroy(false);
    Q.SignUrl("/sign/token");
    Q.Bucket(Bucket);

    $("#selectFiles").change(function() {
        $("#btn_upload").prop("disabled", false);
        var files_arr = [];

        Q.Stop();
        var idx = 0;

        files = document.getElementById("selectFiles").files;
        if (files && files.length) {
            $("#spdiv").show();
            var pro = function(i) {
                return '<div class="progress"> <div id="progressbar' + i + '" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">  </div><div class="pLabel" id="progressbarLabel' + i + '"></div> </div>';
            }
            var tmp = '<table>';
            tmp += "<thead><tr><td>文件名称</td><td>状态</td></tr></thead><tbody>";
            for (i = 0; i < files.length; i++) {
                files_arr.push(files[files.length - i - 1]);
                tmp += "<tr>";
                tmp += '<td class="td_fname">' + files[i].name + "</td>";
                tmp += '<td class="td_pro" id="td_' + i + '">' + pro(i) + '</td>';
                tmp += "</tr>";
            }
            tmp += '<td colspan="4" style="text-align:center;">';
            tmp += "</tbody></table>";
            console.log(tmp);

            $("#selectedPhotoes").html(tmp);
            $("#myModal").modal('show');

            $("#btn_upload").on("click", function() {
                console.log("here");

                if (Q.IsUploading()) {
                    //alert("正在上传")
                    //return
                }

                if ($(this).attr("state") == "pause") {
                    $(this).attr("state", "go-on");
                    $(this).html('<span class="glyphicon glyphicon-play"></span>继续');
                    Q.Pause();
                    return;
                }

                if ($(this).attr("state") == "go-on") {
                    $(this).attr("state", "pause");
                    $(this).html('<span class="glyphicon glyphicon-pause"></span>暂停');
                    Q.Resume();
                    return;
                }


                if ($(this).attr("state") == "start") {

                    Q.addEvent("historyFound", function(his) {
                        if (confirm("文件：" + his + ",未上传完成，是否继续？")) {
                            Q.ResumeHistory();
                        } else {
                            Q.ClearHistory();
                        }
                    });

                    //可以在此回调中添加提交至服务端的额外参数,用于生成上传token
                    //putExtra会
                    Q.addEvent("beforeUp", function() {
                        extra = new Object();
                        extra.aid = AlbumID;
                        Q.SetPutExtra(extra);
                    });

                    //上传失败回调
                    Q.addEvent("putFailure", function(msg) {
                        $("#td_" + idx).html(
                            '<strong>上传失败: </strong> ' + msg
                        )
                        idx++;
                        up();
                    });

                    //上传进度回调
                    // p:0~100
                    Q.addEvent("progress", function(p, s) {
                        $("#progressbar" + idx).attr("style", "width: " + p + "%")
                        $("#progressbarLabel" + idx).text(p + "%" + ", 速度: " + s);
                    });

                    //上传完成回调
                    //fsize:文件大小(MB)
                    //res:上传返回结果，默认为{hash:<hash>,key:<key>}
                    Q.addEvent("putFinished", function(fsize, res, taking) {
                        console.log(res);
                        uploadSpeed = 1024 * fsize / (taking * 1000);
                        if (uploadSpeed > 1024) {
                            formatSpeed = (uploadSpeed / 1024).toFixed(2) + "Mb\/s";
                        } else {
                            formatSpeed = uploadSpeed.toFixed(2) + "Kb\/s";
                        };
                        $("#btn_upload").attr("state", "start");
                        $("#btn_upload").html('<span class="glyphicon glyphicon-cloud-upload"></span>上传');
                        $("#td_" + idx).html("上传成功")
                        $("#progressbar" + idx).attr("style", "width: 100%");
                        $("#progressbarLabel" + idx).html("上传成功!平均速度:" + formatSpeed);
                        idx++;
                        $.ajax({
                            method: "post",
                            url: "/callback/returnbody",
                            data: res,
                        }).done(function() {});
                        up();
                    });

                    var up = function() {
                        console.log("up...")
                        if (files_arr && files_arr.length) {
                            $("#btn_upload").prop("disabled", true)
                            var f = files_arr.pop();
                            $(this).attr("state", "pause");
                            $(this).html('<span class="glyphicon glyphicon-pause"></span>暂停');
                            console.log("uploading file:", f.name);
                            Q.Upload(f);
                        } else {
                            $("#btn_upload").prop("disabled", false);
                        }
                    };
                    up();
                    return;
                }
            })
        } else {
            $("#spdiv").hidden();
        }
    });
});
