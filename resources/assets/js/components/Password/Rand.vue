<template>
    <div class="modal fade rand-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">生成随机密码</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                        <label for="randPassword" class="control-label">密码:</label>
                        <div class="input-group">
                            <input type="text" name="randPassword" class="form-control" id="randPassword"
                                   v-model="randPassword"
                                   required="required">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" @click="getRand">
                                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                                    </button>
                                  </span>
                        </div>

                        <a tabindex="0" style="margin-top:5px" class="btn btn-sm pull-right btn-info copy-password"
                           role="button"
                           data-toggle="popover"
                           data-trigger="focus" data-content="复制成功" v-clipboard="randPassword" @success="handleSuccess">复制密码</a>
                        <div class="clearfix"></div>
                    </div>


                    <div class="form-group">
                        <label for="size" class="control-label">长度:</label>
                        <select class="form-control" v-model="size" id="size" required="required">
                            <option value="8">8</option>
                            <option value="12">12</option>
                            <option value="16">16</option>
                            <option value="20">20</option>
                            <option value="24">24</option>
                            <option value="28">28</option>
                            <option value="32">32</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">生成规则:</label>

                        <div>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" value="true" v-model="upper"> 大写
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" value="true" v-model="lower"> 小写
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox3" value="true" v-model="number"> 数字
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox4" value="true" v-model="special"> 特殊字符
                            </label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                randPassword: '',
                size: 16,
                upper: true,
                lower: true,
                number: true,
                special: true,
                time:''
            };
        },

        mounted(){
            this.getRand();
        },

        methods: {
            getRand(){
                let url = '/tools/password/rand';
                let params = {
                    special: this.special,
                    number: this.number,
                    lower: this.lower,
                    upper: this.upper,
                    size: this.size,
                };
                axios.get(url, {
                    params: params
                })
                    .then(response => {
                        if (response.data.code == 0) {
                            this.randPassword = response.data.data.password;
                        } else {

                        }

                    })
                    .catch(error => {
                        if (error.response) {
                            console.log(error.response.data.message);
                        }
                    });
            },
            handleSuccess: function (e) {
                Vue.nextTick(() => {
                    $('.copy-password').popover('hide');
                    $('.copy-password').popover('toggle');
                });
            }
        }
    }
</script>