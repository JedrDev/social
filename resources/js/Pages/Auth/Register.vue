<template>
    <Head title="Register" />

    <authentication-card>
        <template #logo>
            <authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit" id="register">
            <p v-if="errors.length">
                <jet-validation-errors :errors="errors" />
            </p>
            <div>
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="nickname" value="Nickname" />
                <jet-input id="nickname" type="text" class="mt-1 block w-full" v-model="form.nickname" required />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>

        <template #footer>
            <div class="flex justify-center">
                <spam class="text-sm text-gray-600 mr-2">Already registered?</spam>
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Log in
                </Link>
            </div>
        </template>
    </authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import AuthenticationCard from '@/Components/AuthenticationCard.vue'
    import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            AuthenticationCard,
            AuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Head,
            Link
        },
        data() {
            return {
                form: {
                    name: null,
                    nickname: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                    terms: false,
                    processing: false,
                },
                errors: [],
            };
        },

        methods: {
            submit(){

                this.$inertia.post(this.route('register'), this.form);

            },

        },
    };
   /* export default defineComponent({
        components: {
            Head,
            AuthenticationCard,
            AuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    //snickname: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            checkForm: function(e) {
                if (this.form.name && this.form.nickname && this.form.email && this.form.password && this.form.password_confirmation) {
                    this.submit()
                }
                this.errors = [];
                if(this.form.password !== this.form.password_confirmation) {
                    this.$validator.errors.add('password_confirmation', 'The password confirmation does not match.')
                }
                if (this.form.password.length < 6) {
                    this.$validator.errors.add('password', 'The password must be at least 6 characters.')
                }
                if (this.form.password.length > 255) {
                    this.$validator.errors.add('password', 'The password may not be greater than 255 characters.')
                }
                if (this.form.nickname === '') {
                    this.$validator.errors.add('nickname', 'The nickname field is required.')
                }
                e.preventDefault();
            },
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })*/
</script>
