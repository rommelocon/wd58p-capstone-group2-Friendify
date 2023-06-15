<div class="w-full" x-data="{ open: false }">
    <!-- Modal Trigger -->
    <button x-on:click.prevent="$dispatch('open-modal','post-modal')" class="text-left w-full h-auto p-2 border border-gray-300 rounded-lg font-sans text-sm leading-5 resize-vertical bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id=" modal-toggle">
        Write your post...
    </button>

    <!-- Modal -->
    <x-modal name="post-modal" class="vertical-center">
        <div class="w-full bg-transparent my-auto">
            <div class="w-full inset-0 overflow-y-auto">

                <div class=" rounded-lg shadow-lg p-6 bg-transparent">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">New Post</h2>
                        <button x-on:click="$dispatch('close')" class="text-gray-600">
                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.415-1.415l2.929-2.93L4.646 6.464a1 1 0 011.415-1.415L10 8.586l2.93-2.93a1 1 0 011.414 1.415l-2.93 2.929 2.93 2.93a1 1 0 010 1.414z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Content -->
                    <div>
                        <form method="POST" action="{{ route('posts.store') }}" class="mb-4" enctype="multipart/form-data">
                            @csrf
                            <div class="w-full flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg">
                                <textarea name="content" class="description bg-gray-100 sec p-3 h-40 border border-gray-300 outline-none resize-none" spellcheck="false" placeholder="Describe everything about this post here"></textarea>

                                <div class="mt-3">
                                    <!-- Image Upload -->
                                    <label for="image" class="cursor-pointer">
                                        <svg version="1.0" class="text-gray-500 hover:text-gray-700 h-7 w-7 inline-block" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                <path d="M1150 4671 c-73 -23 -125 -57 -183 -120 -58 -62 -92 -132 -107 -221
-8 -46 -10 -460 -8 -1385 l3 -1320 22 -58 c43 -115 139 -214 250 -258 l58 -24
1765 -3 c1290 -2 1781 0 1825 8 165 32 303 171 335 335 8 43 10 429 8 1400
l-3 1340 -22 53 c-32 80 -97 158 -166 203 -115 74 38 69 -1941 68 -1675 0
-1784 -1 -1836 -18z m3639 -217 c66 -33 107 -93 116 -168 3 -28 5 -482 3
-1010 l-3 -958 -473 551 c-259 303 -491 565 -514 581 -106 77 -261 76 -372 -3
-22 -16 -328 -379 -883 -1046 -2 -3 -81 72 -176 167 -202 201 -227 216 -352
216 -146 1 -138 6 -632 -487 l-433 -431 0 1227 c0 1189 1 1229 19 1265 11 20
32 49 48 64 64 61 -67 57 1849 58 l1750 0 53 -26z m-991 -1182 c13 -9 268
-303 567 -652 l544 -635 1 -143 c0 -79 -5 -164 -12 -190 -16 -64 -86 -134
-150 -150 -61 -16 -3464 -17 -3519 -2 -20 6 -51 20 -69 33 -71 48 -100 12 435
547 322 322 498 491 515 495 15 3 40 1 56 -5 16 -6 121 -103 234 -215 113
-112 218 -209 234 -215 67 -25 64 -28 567 575 309 371 479 567 497 574 33 12
69 6 100 -17z" />
                                                <path d="M1790 4032 c-73 -24 -125 -59 -183 -121 -155 -166 -149 -420 14 -584
246 -246 659 -111 719 234 24 136 -26 275 -134 377 -84 78 -148 104 -271 109
-68 2 -104 -1 -145 -15z m215 -211 c158 -71 167 -296 15 -380 -93 -52 -211
-23 -274 67 -40 57 -48 149 -18 208 55 107 174 152 277 105z" />
                                                <path d="M478 3035 c-16 -9 -33 -32 -42 -57 -38 -101 -428 -1578 -433 -1638
-14 -168 88 -343 240 -413 29 -13 308 -93 622 -177 314 -83 1065 -285 1670
-447 605 -162 1128 -298 1161 -300 158 -14 333 85 404 227 32 64 200 679 200
732 0 45 -38 94 -79 103 -36 8 -96 -16 -111 -45 -9 -17 -190 -670 -190 -686 0
-3 -19 -25 -41 -49 -31 -34 -55 -49 -96 -61 -62 -18 -54 -19 -318 52 -110 29
-857 229 -1660 444 -1578 422 -1515 402 -1562 484 -46 83 -51 56 182 924 118
441 215 814 215 828 0 16 -13 39 -34 60 -38 38 -81 44 -128 19z" />
                                            </g>
                                        </svg>
                                        <span class="ml-2 text-gray-700">Upload Image</span>
                                        <input id="image" type="file" name="image" class="hidden">
                                    </label>

                                    <!-- Video Upload -->
                                    <label for="video" class="cursor-pointer">
                                        <svg version="1.0" class="text-gray-500 hover:text-gray-700 h-7 w-7 inline-block" xmlns="http://www.w3.org/2000/svg" width="512.000000pt" height="512.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet">
                                            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                                <path d="M3820 5105 c-30 -7 -748 -214 -1595 -459 -1086 -315 -1561 -457
-1612 -482 -192 -93 -318 -319 -300 -533 3 -39 42 -190 94 -366 l88 -300 5
-1260 c6 -1379 1 -1281 68 -1410 75 -143 233 -258 389 -284 47 -8 262 -11 705
-9 l638 3 26 27 c37 37 37 99 0 136 l-26 27 -663 5 c-705 6 -686 4 -767 55
-75 48 -128 118 -154 205 -14 47 -16 144 -16 757 l0 703 1958 -2 1957 -3 3
-665 c1 -373 -2 -695 -7 -733 -18 -127 -86 -224 -199 -279 l-67 -33 -660 -5
c-363 -3 -668 -9 -677 -13 -27 -14 -48 -53 -48 -90 0 -39 34 -83 72 -92 12 -3
320 -4 683 -3 656 3 660 3 719 26 83 31 142 68 205 126 69 65 114 135 148 233
l28 78 0 1263 0 1264 -33 29 -32 29 -1717 0 c-944 0 -1714 2 -1712 5 3 2 743
218 1645 479 1788 518 1684 484 1684 559 0 53 -176 645 -215 724 -107 217
-381 345 -615 288z m267 -219 c67 -30 140 -98 172 -161 17 -34 153 -482 163
-539 3 -17 -20 -26 -195 -78 l-199 -57 -136 132 c-75 74 -237 230 -360 347
-122 118 -219 217 -215 220 7 6 438 132 548 161 57 15 157 4 222 -25z m-646
-546 c194 -186 355 -343 357 -348 1 -4 -116 -42 -260 -84 l-263 -75 -130 127
c-71 69 -232 225 -357 345 -126 120 -228 221 -228 224 0 7 485 149 511 150 9
1 175 -152 370 -339z m-693 -275 c166 -159 298 -292 294 -296 -8 -8 -494 -149
-512 -149 -6 0 -173 156 -371 347 l-360 347 263 76 263 76 61 -55 c33 -31 196
-186 362 -346z m-808 -165 c228 -218 355 -347 347 -351 -6 -4 -125 -39 -264
-79 l-252 -73 -361 349 c-219 210 -357 350 -349 353 56 19 506 149 511 147 4
0 170 -156 368 -346z m-751 -220 c198 -189 359 -345 358 -347 -11 -10 -872
-251 -878 -246 -4 5 -40 121 -80 258 -64 218 -73 260 -73 330 0 65 5 90 25
135 28 61 74 118 122 152 36 26 137 69 154 65 7 -1 174 -157 372 -347z m381
-837 c0 -3 -93 -167 -207 -365 l-207 -358 -228 0 -228 0 0 365 0 365 435 0
c239 0 435 -3 435 -7z m787 0 c-3 -5 -96 -165 -207 -358 -111 -192 -205 -353
-209 -358 -4 -4 -130 -6 -279 -5 l-272 3 196 340 c108 187 202 350 210 363 14
22 15 22 290 22 151 0 273 -3 271 -7z m781 -2 c-1 -4 -95 -169 -208 -364
l-205 -356 -279 -1 -278 0 14 23 c8 12 104 176 212 365 l198 342 275 0 c151 0
273 -4 271 -9z m580 -356 l-211 -365 -274 0 c-172 0 -273 4 -271 10 2 5 95
169 208 364 l205 356 277 0 276 0 -210 -365z m902 0 l0 -365 -441 0 c-242 0
-438 3 -436 8 23 41 393 683 403 700 14 22 17 22 244 22 l230 0 0 -365z" />
                                                <path d="M2330 1662 c-19 -9 -40 -28 -47 -42 -10 -19 -13 -152 -13 -557 l0
-533 29 -32 c55 -62 53 -63 564 232 342 198 462 272 473 292 21 41 17 74 -13
107 -29 32 -891 533 -934 544 -15 4 -39 0 -59 -11z m493 -462 c119 -69 216
-128 214 -132 -2 -7 -553 -328 -562 -328 -3 0 -5 149 -5 331 l0 331 68 -39
c38 -21 166 -94 285 -163z" />
                                                <path d="M2615 189 c-98 -57 -50 -205 59 -185 108 20 104 176 -5 192 -18 2
-43 -1 -54 -7z" />
                                            </g>
                                        </svg>
                                        <span class="ml-2 text-gray-700">Upload Video</span>
                                        <input id="video" type="file" name="video" class="hidden">
                                    </label>
                                </div>

                                <!-- Buttons -->
                                <div class="mt-4 text-center">
                                    <x-primary-button class="w-full" display="block">{{ __('Post') }}</x-primary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
</div>