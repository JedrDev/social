<template>
    <div class="flex w-full  items-center justify-center mx-auto ">
        <div class="border w-5/6 bg-white my-3 rounded-2xl p-4 shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-80">
            <div class="flex items-center	justify-between">
                <div class="gap-3.5	flex items-center ">
                    <img :src="post.user.profile_photo_url" :alt="post.user.name" class="h-12 w-12 rounded-full object-cover"/>
                    <div class="flex flex-col">
                        <b class="mb-1 capitalize cursor-pointer">{{post.user.nickname}}</b>
                        <time class="text-gray-400 text-xs">{{getDifferenceTime(post.created_at)}}</time>
                    </div>
                </div>
                <div class="bg-gray-100	rounded-full h-3.5 flex	items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="34px" fill="#92929D">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                    </svg>
                </div>
            </div>
            <div class="whitespace-pre-wrap mt-7">{{post.description}}</div>
            <div class="mt-5 flex gap-2	 justify-center border-b pb-4 flex-wrap	">
                <img :src="post.photo_url" class="bg-red-500 w-1/3 object-cover flex-auto" :alt="post.description">
            </div>
                <div class=" h-16 border-b  flex items-center justify-around	">
                    <!--COMENTARIOS-->
                    <div class="flex items-center	gap-3	">
                        <svg width="20px" height="19px" viewBox="0 0 20 19" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" class="cursor-pointer">
                            <g id="🎳-Social-Media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Square_Timeline" transform="translate(-312.000000, -746.000000)">
                                    <g id="Post-1" transform="translate(280.000000, 227.000000)">
                                        <g id="Post-Action" transform="translate(0.000000, 495.000000)">
                                            <g transform="translate(30.000000, 21.000000)" id="Comment">
                                                <g>
                                                    <g id="ic_comment-Component/icon/ic_comment">
                                                        <g id="Comments">
                                                            <polygon id="Path" points="0 0 24 0 24 25 0 25"></polygon>
                                                            <g id="iconspace_Chat-3_25px"
                                                                transform="translate(2.000000, 3.000000)" fill="#92929D">
                                                                <path
                                                                    d="M10.5139395,15.2840977 L6.06545155,18.6848361 C5.05870104,19.4544672 3.61004168,18.735539 3.60795568,17.4701239 L3.60413773,15.1540669 C1.53288019,14.6559967 0,12.7858138 0,10.5640427 L0,4.72005508 C0,2.11409332 2.10603901,0 4.70588235,0 L15.2941176,0 C17.893961,0 20,2.11409332 20,4.72005508 L20,10.5640427 C20,13.1700044 17.893961,15.2840977 15.2941176,15.2840977 L10.5139395,15.2840977 Z M5.60638935,16.5183044 L9.56815664,13.4896497 C9.74255213,13.3563295 9.955971,13.2840977 10.1754888,13.2840977 L15.2941176,13.2840977 C16.7876789,13.2840977 18,12.0671403 18,10.5640427 L18,4.72005508 C18,3.21695746 16.7876789,2 15.2941176,2 L4.70588235,2 C3.21232108,2 2,3.21695746 2,4.72005508 L2,10.5640427 C2,12.0388485 3.1690612,13.2429664 4.6301335,13.28306 C5.17089106,13.297899 5.60180952,13.7400748 5.60270128,14.2810352 L5.60638935,16.5183044 Z"
                                                                    id="Path"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <div class="text-sm	">{{post.countComments}} Comments</div>
                    </div>
                    <!--fin COMENTARIOS-->
                    <!--LIKES-->
                    <div class="flex items-center	gap-3">
                        <div v-if="post.isliked">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 26 26" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>

                        <div class="text-sm">{{post.countLikes}} Likes</div>
                    </div>
                    <!--FIN LIKS-->
                    <!--funcion para guardar post-->
                    <div class="flex items-center	gap-3">
                        <svg width="17px" height="22px" viewBox="0 0 17 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="🎳-Social-Media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Square_Timeline" transform="translate(-787.000000, -745.000000)">
                                    <g id="Post-1" transform="translate(280.000000, 227.000000)">
                                        <g id="Post-Action" transform="translate(0.000000, 495.000000)">
                                            <g transform="translate(30.000000, 21.000000)" id="Saved">
                                                <g transform="translate(473.000000, 1.000000)">
                                                    <g id="ic_Saved-Component/icon/ic_Saved">
                                                        <g id="Saved">
                                                            <circle id="Oval" cx="12" cy="12" r="12"></circle>
                                                            <g id="Group-13-Copy" transform="translate(5.000000, 2.000000)"
                                                                fill="#92929D">
                                                                <path
                                                                    d="M2.85714286,-0.952380952 L12.1428571,-0.952380952 C14.246799,-0.952380952 15.952381,0.753200953 15.952381,2.85714286 L15.952381,18.2119141 C15.952381,19.263885 15.09959,20.116746 14.047619,20.116746 C13.6150601,20.116746 13.1953831,19.9694461 12.8576286,19.6992071 L7.5,15.4125421 L2.14237143,19.6992071 C1.32096217,20.3564207 0.122301512,20.2233138 -0.534912082,19.4019046 C-0.805151112,19.0641501 -0.952380952,18.644473 -0.952380952,18.2119141 L-0.952380952,2.85714286 C-0.952380952,0.753200953 0.753200953,-0.952380952 2.85714286,-0.952380952 Z M2.85714286,0.952380952 C1.80517191,0.952380952 0.952380952,1.80517191 0.952380952,2.85714286 L0.952380952,18.2119141 L6.31000952,13.9252491 C7.00569973,13.3686239 7.99430027,13.3686239 8.68999048,13.9252491 L14.047619,18.2119141 L14.047619,2.85714286 C14.047619,1.80517191 13.1948281,0.952380952 12.1428571,0.952380952 L2.85714286,0.952380952 Z"
                                                                    id="Rectangle-92"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <div class="text-sm">Saved</div>
                    </div>
                    <!-- fin funcion para guardar post-->
                </div>
                <div class="pt-1">
                    <div v-if="post.comments.length > 0" >
                        <div v-for="(comment, index) in post.comments" :key="index" class="text-sm mb-2 flex flex-start items-center">
                            <div>
                                <a href="#" class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        :src="comment.user.profile_photo_url"
                                        :alt="comment.user.nickname" />
                                </a>
                            </div>
                            <p class="font-bold ml-2">
                                <a class="cursor-pointer">{{comment.user.nickname}}:</a>
                                <span class="text-gray-700 font-medium ml-1">
                                    {{comment.comment}}
                                </span>
                                </p>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <img :src="$page.props.user.profile_photo_url" class="h-8 w-8 rounded-full object-cover">
                    <div class="flex items-center justify-between bg-gray-50 h-11 w-11/12 focus:w-9/12 ml-6 border rounded-2xl focus:border-gray-800 overflow-hidden">
                        <input v-model="textComment" class="w-full h-full resize-none outline-none appearance-none pl-1" aria-label="Write your comment..." placeholder="Write your comment..." name="comment"/>
                    </div>
                    <button v-if="textComment.length > 0" class="mb-1 ml-2 focus:outline-none border-none bg-transparent text-blue-600">Post</button>
                </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment'
    export default {
        data() {
            return {
                textComment: '',
            }
        },
        props: ['post'],
        methods:{
            getDifferenceTime(time){
                return moment(time).fromNow(true)
            },
        }
    }
</script>
