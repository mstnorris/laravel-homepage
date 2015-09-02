<!DOCTYPE html>
<html>
<head>
    <title>Laravel Homepage</title>
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            padding-top: 2em;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Open Sans', sans-serif;
        }

        * {
            color: #607d8b;
        }

    </style>
</head>
<body>
<div id="sites" class="container">

    <div class="modal fade" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Add New Site</h4>
                </div>
                <form method="POST" v-on="submit: onSubmitForm">
                <div class="modal-body">



                        <div class="form-group">
                            <label for="title">
                                Title:
                                <span class="error" v-if="! newSite.title">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control" v-on="keyup: changeEvent"
                                   v-model="newSite.title" autocomplete="off" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="url">
                                URL:
                                <span class="error" v-if="! newSite.url">*</span>
                            </label>
                            <input type="text" name="url" id="url" class="form-control" v-on="blur: changeEvent" v-model="newSite.url" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="category_id">
                                Category:
                                <span class="error" v-if="! newSite.category_id">*</span>
                            </label>
                            <input type="text" name="category_id" id="category_id" class="form-control" v-on="blur: changeEvent" v-model="newSite.category_id" autocomplete="off">
                        </div>






                            <a href="@{{ newSite.url }}">
                                <div class="card" id="new-site" style="background-image: @{{ newSite.background_image }}">
                                    <div class="card-block">
                                        <h4 class="card-title">@{{ newSite.title }}</h4>

                                        <p class="card-text">@{{ newSite.category_id }}</p>
                                    </div>
                                </div>
                            </a>


                </div>
                <div class="modal-footer">


                    <button type="submit" class="btn btn-default" v-attr="disabled: errors">Add Site</button>

                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="card-columns">
        <div class="card card-primary" data-toggle="modal" data-target="#myModal">
            <div class="card-block">
                <h4 class="card-title">New Site</h4>

                {{--<p class="card-text">@{{ category_id }}</p>--}}
            </div>
        </div>
        <a href="@{{ url }}" v-repeat="sites">
            <div class="card" style="background-image: @{{ background_image }}">
                <div class="card-block">
                    <h4 class="card-title">@{{ title }}</h4>

                    <p class="card-text">@{{ category_id }}</p>
                </div>
            </div>
        </a>
    </div>

    {{--<pre>@{{ $data | json }}</pre>--}}

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.15/vue-resource.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/geopattern.min.js"></script>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

    new Vue({
        el: '#sites',

        data: {
            newSite: {
                title: 'Title',
                url: 'http://domain.com',
                background_image: '',
                category_id: '1',
            }
        },

        computed: {
            errors: function () {
                for (var key in this.newSite) {
                    if (!this.newSite[key]) return true;
                }

                return false;
            }
        },

        ready: function () {
            this.fetchSites();
            this.changeEvent();
        },

        methods: {
            fetchSites: function () {
                this.$http.get('sites', function (sites) {
                    this.$set('sites', sites);
                })
            },

            onSubmitForm: function (e) {
                e.preventDefault();

                var site = this.newSite;

                this.sites.push(site);

                this.newSite = {title: '', url: '', background_image: '', category_id: ''};

                this.$http.post('sites', site);
            },

            changeEvent: function () {
                var pattern = GeoPattern.generate({
                    string: this.newSite.title + this.newSite.url,
                    baseColor: '#ffffff'
                });

                this.newSite.background_image = pattern.toDataUrl();
                $("#new-site").css('background-image', pattern.toDataUrl());
            }
        }
    });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
</body>
</html>
