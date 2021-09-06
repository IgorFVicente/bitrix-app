<template>
    <div class="createCompany">
        <div class="formHeading"><h2>NOVA EMPRESA</h2></div>
        <div class="companyFormDiv">
            <form :action="formRoute" method="POST" class="companyForm">
                <ul>
                <li>
                    <label for="title" class="formLabel">Nome da empresa:</label>
                    <input type="text" name="title" required>
                </li>
                <li>
                    <label for="" class="formLabel">Receita Anual:</label> 
                    <input type="text" name="revenue">
                </li>
                <li v-for="(phone, index, i) in phones">
                    <label for="">Telefone {{index + 1}}</label><br/>
                    <input type="text" :name="'phone[' + index + ']'" :value="phone">
                </li>
                <li class="formButton">
                    <button class="bitrixBtn" type="button" @click.prevent="addPhone(phones)">Adicionar Telefone</button>
                </li>
                <li v-for="(email, index, i) in emails">
                    <label for="">E-mail {{index + 1}}</label><br/>
                    <input type="text" :name="'email[' + index + ']'" :value="email">
                </li>
                <li class="formButton">
                    <button class="bitrixBtn" type="button" @click.prevent="addEmail(emails)">Adicionar e-mail</button>
                </li>
                <template v-for="(contact, index, i) in contacts">
                        <input class="hiddenInput" type="text" :name="'contact_id[' + index +']'" :value="contact.ID">
                    <li>
                        <label for="">Nome do Contato {{index + 1}}:</label><br/>
                        <input type="text" :name="'contact_name[' + index + ']'" :value="contact.NAME">
                    </li>
                    <li>    
                        <label for="">Sobrenome do Contato {{index + 1}}:</label><br/>
                        <input type="text" :name="'contact_lastname[' + index + ']'" :value="contact.LAST_NAME">
                    </li>
                </template>
                <li class="formButton">
                    <button class="bitrixBtn" type="button" @click.prevent="addContact(contacts)">Adicionar contato</button>
                </li>
                <li>
                    <button type="submit" <button class="bitrixBtn saveBtn">SALVAR</button>
                    <a href="/"><button type="button" class="bitrixBtn backBtn">VOLTAR</button></a>
                </li>
                </ul>
            </form>
        </div>
    </div>
</template>

<script>
import AddFormFieldButton from '../components/AddFormFieldButton.vue'
import MaskedInput from 'vue-masked-input'

export default {
    data() {
        return { 
            phones: [""],
            emails: [""],
            contacts: [{
                NAME: "",
                LAST_NAME: ""
            }]
        }
    },
    methods: {
        addPhone(phones) {   
            phones.push('')
        },
        addEmail(emails) {
            emails.push('')
        },
        addContact(contacts) {
            let contactCount = contacts.length
            contacts.push({
                ID: 0,
                NAME: "",
                LAST_NAME: ""
            })
        }
    },
    props: ['formRoute']    
}
</script>

<style scoped>

    .hiddenInput {
        display: none;
        visibility: hidden;
    }
    
    .createCompany {
        max-width: 100%;
        background: #fff;
        margin: 10px;
        padding: 20px;
    }

    .formHeading {
        font-weight: 900;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .companyForm {
        max-width:400px;
        margin:30px;
        background:#fff;
        border-radius:2px;
        padding:20px;
    }

    .companyForm ul {
        list-style:none;
        padding:0;
        margin:0;	
    }

    .companyForm li {
        display: block;
        padding: 9px;
        border:1px solid #DDDDDD;
        margin-bottom: 30px;
        border-radius: 3px;
    }

    .companyForm li:last-child {
        border:none;
        margin-bottom: 0px;
        text-align: center;
    }

    .companyForm li > label {
        display: block;
        float: left;
        margin-top: -19px;
        background: #FFFFFF;
        height: 25px;
        padding: 2px 5px 2px 5px;
        color: #00000;
        font-size: 14px;
        overflow: hidden;
    }

    .companyForm input[type="text"],
    .companyForm input[type="email"]
    {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        display: block;
        outline: none;
        border: none;
        height: 15px;
        line-height: 15px;
        font-size: 16px;
        padding: 0;
    }

    .companyForm input[type="text"]:focus,
    .companyForm input[type="email"]:focus
    {
    }

    .formButton {
        border: none !important;
    }

    .bitrixBtn {
        background-color: #d2dee1;
        background-image: -webkit-linear-gradient(top, #dce5e7, #becfd3);
        background-image: -moz-linear-gradient(top, #dce5e7, #becfd3);
        background-image: -ms-linear-gradient(top, #dce5e7, #becfd3);
        background-image: -o-linear-gradient(top, #dce5e7, #becfd3);
        background-image: linear-gradient(to bottom, #dce5e7, #becfd3);
        border: 1px solid;
        border-top-color: currentcolor;
        border-right-color: currentcolor;
        border-bottom-color: currentcolor;
        border-left-color: currentcolor;
        border-color: #c8d1d4 #b1bcc0 #98a4a9;
        border-radius: 5px;
        -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .5), 0 1px 1px 0 rgba(0, 0, 0, .23);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .5), 0 1px 1px 0 rgba(0, 0, 0, .23);
        color: #555555;
        cursor: pointer;
        display: inline-block;
        height: 32px;
        line-height: 30px;
        font-size: 14px;
        font-weight: bold;
        min-width: 70px;
        padding: 0 14px;
        text-shadow: 0 1px #fff;
        text-align: center;
        vertical-align: middle;
    }

    .bitrixBtn:hover {
        background-image: linear-gradient(to bottom, #eef4f5, #e0eaed);
    }

    .bitrixBtn:active {
        background: #b4c3c8 !important;
        border-color: #979ea4 #adbabf #b4c3c8;
        -webkit-box-shadow: inset 0 1px 0 #9ea8ad, inset 0 2px 0 #adbabf;
        box-shadow: inset 0 1px 0 #9ea8ad, inset 0 2px 0 #adbabf;
        border-radius: 4px;
    }

    .backBtn {
        height: 40px !important;
        width: 100px !important;
        background-color: #d74c4c;
        background-image: -webkit-linear-gradient(top, #e15a5a, #c83a3a);
        background-image: -moz-linear-gradient(top, #e15a5a, #c83a3a);
        background-image: -ms-linear-gradient(top, #e15a5a, #c83a3a);
        background-image: -o-linear-gradient(top, #e15a5a, #c83a3a);
        background-image: linear-gradient(to bottom, #e15a5a, #c83a3a);
        border-color: #d45454 #c53131 #b50a0a;
        -webkit-box-shadow: inset 0 1px 0 #f08787, 0 1px 1px 0 rgba(0, 0, 0, .23);
        box-shadow: inset 0 1px 0 #f08787, 0 1px 1px 0 rgba(0, 0, 0, .23);
        color: #ffffff;
        text-shadow: 0 1px rgba(0,0,0,.2);
    }

    .backBtn:hover {
        background-color: #e56e6e;
        background-image: -webkit-linear-gradient(top, #ec8585, #dd5555);
        background-image: -moz-linear-gradient(top, #ec8585, #dd5555);
        background-image: -ms-linear-gradient(top, #ec8585, #dd5555);
        background-image: -o-linear-gradient(top, #ec8585, #dd5555);
        background-image: linear-gradient(to bottom, #ec8585, #dd5555);
        -webkit-box-shadow: inset 0 1px 0 #f6c2c2, 0 1px 1px 0 rgba(0, 0, 0, .23);
        box-shadow: inset 0 1px 0 #f6c2c2, 0 1px 1px 0 rgba(0, 0, 0, .23);
    }

    .backBtn:active {
        background: #bb3131 !important;
        border-color: #8b0202 #970d0d #af2525;
        -webkit-box-shadow: inset 0 1px 0 #970d0d, inset 0 2px 0 #af2525;
        box-shadow: inset 0 1px 0 #970d0d, inset 0 2px 0 #af2525;
        border-radius: 4px;
    }

    .saveBtn {
        height: 40px !important;
        width: 100px !important;
        background-color: #95b91b;
        background-image: -webkit-linear-gradient(top, #a4c31e, #80ab17);
        background-image: -moz-linear-gradient(top, #a4c31e, #80ab17);
        background-image: -ms-linear-gradient(top, #a4c31e, #80ab17);
        background-image: -o-linear-gradient(top, #a4c31e, #80ab17);
        background-image: linear-gradient(to bottom, #a4c31e, #80ab17);
        -webkit-box-shadow: inset 0 1px 0 #d2e12d, 0 1px 1px 0 rgba(0, 0, 0, .23);
        box-shadow: inset 0 1px 0 #d2e12d, 0 1px 1px 0 rgba(0, 0, 0, .23);
        border-color: #a3c926 #8bb01c #739913;
        color: #ffffff;
    }

    .saveBtn:hover {
        background-color: #a9cf2f;
        background-image: -webkit-linear-gradient(top, #b5d534, #97c528);
        background-image: -moz-linear-gradient(top, #b5d534, #97c528);
        background-image: -ms-linear-gradient(top, #b5d534, #97c528);
        background-image: -o-linear-gradient(top, #b5d534, #97c528);
        background-image: linear-gradient(to bottom, #b5d534, #97c528);
    }
    .saveBtn:active {
        background: #789e12 !important;
        border-color: #5c7619 #719414 #789e12;
        -webkit-box-shadow: inset 0 1px 0 #638017, inset 0 2px 0 #719414;
        box-shadow: inset 0 1px 0 #638017, inset 0 2px 0 #719414;
        border-radius: 4px;
    }
</style>