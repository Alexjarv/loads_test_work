<template>
    <main class="pt-10 pb-20">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold">Біржа вантажів</h1>
            <div class="flex flex-col pt-4 pb-8 gap-y-2 lg:w-2/3 xl:w-1/2">
                <button @click="showModal = !showModal" class="border-none rounded bg-blue-600 text-white font-bold py-2 px-8 inline-block mr-auto">
                    Додати
                </button>
                <div class="">Всього: {{ loads.length }} вантажів</div>
                <div class="w-full border divide-y">
                    <div class="grid grid-cols-5 font-bold">
                        <div class="py-1 px-4">Дата</div>
                        <div class="py-1 px-4 col-span-2">Маршрут</div>
                        <div class="py-1 px-4">Вантаж</div>
                        <div class="py-1 px-4">Вага</div>
                    </div>
                    <div @click="selected = index" v-for="(load, index) in loads" v-bind:key="load.id" class="divide-y flex flex-col">
                            <div :class="{ 'border border-blue-600': selected == index }" class="divide-y">
                                <div class="w-full grid grid-cols-5">
                                    <div class="py-1 px-4">{{load.date}}</div>
                                    <div class="py-1 px-4 col-span-2">{{load.name}}</div>
                                    <div class="py-1 px-4">{{load.title}}</div>
                                    <div class="py-1 px-4">{{load.weight}}</div>
                                </div>
                                <div :class="{ 'hidden': selected != index }" class="h-80">

                                    <iframe v-bind:src="generateSrc(load.name)" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!--TODO Для відображення модалу видалити класс hidden у наступного блоку-->
        <!--modal overlay-->
        <div :class="{'hidden' : !showModal}" class="fixed inset-0 flex items-center justify-center" style="background: rgba(0, 0, 0, 0.4)">
            <!--    modal body-->
            <div class="bg-white w-1/3 p-5 flex flex-col gap-4 relative">
                <!--        close button-->
                <button @click="showModal = !showModal" class="absolute right-5 top-5 h-4 w-4">
                    <span class="bg-gray-300 absolute transform rotate-45 block h-0.5 w-4"></span>
                    <span class="bg-gray-300 absolute transform -rotate-45 block h-0.5 w-4"></span>
                </button>
                <!--        title-->
                <h2 class="text-xl font-bold">Нове замовлення</h2>
                <!--        form-->
                <form @submit.prevent="submit" class="flex flex-col gap-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <label>
                            <input class="border rounded py-2 px-4 w-full" type="text" v-model="from" name="from" placeholder="Звідки">
                        </label>
                        <label>
                            <input class="border rounded py-2 px-4 w-full" type="text" v-model="to" name="to" placeholder="Куди">
                        </label>
                        <label>
                            <input class="border rounded py-2 px-4 w-full" type="text" v-model="title" name="title" placeholder="Назва вантажу">
                        </label>
                        <label>
                            <input class="border rounded py-2 px-4 w-full" type="text" v-model="weight" name="weight" placeholder="Вага, кг">
                        </label>
                    </div>
                    <button class="border-none rounded bg-blue-600 text-white font-bold py-2 px-8 inline-block ml-auto">
                        Додати
                    </button>
                </form>
            </div>
        </div>
    </main>
</template>

<script>
        export default {

            data() {
                return {
                    showModal: false,
                    selected: 0,
                    loads: [],
                    title: '',
                    weight: '',
                    from: '',
                    to: '',
                    pagination: {},
                }
            },

            created() {
                this.fetchLoads();
            },

            methods: {
                fetchLoads(){
                    fetch('api/load')
                        .then(res => res.json())
                        .then(res => {
                            this.loads = res;
                            console.log(this.loads);
                        })
                },
                submit(){
                    axios.post('api/load', {title: this.title, weight: this.weight, from: this.from, to: this.to})
                    .then(res => {
                        console.log(this.loads);
                        this.loads.unshift({date: res.data.points[0].date, name: res.data.points[0].name , title: res.data.title, weight: res.data.weight}); // what to push unto the rows array?
                        this.showModal = !this.showModal;
                        console.log(this.loads);

                        this.title = '';
                        this.weight = '';
                        this.from = '';
                        this.to = '';
                    })
                    .catch(err => {
                        //catch error
                    });
                },
                generateSrc($route){
                    $route = $route.trim();
                    $route = $route.split('-');
                    return 'https://www.google.com/maps/embed/v1/directions?key=AIzaSyCc7fkIndKjHYcamjMG7BvU9FAYqx-CyDU&origin=' + $route[0] + '&destination=' + $route[1] + '&avoid=tolls|highways';
                }
            }
        }
</script>
