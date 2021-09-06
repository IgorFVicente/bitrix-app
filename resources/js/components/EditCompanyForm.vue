<template>
    <div class="editCompany">
        <div class="editHeading"><h2>EDITAR EMPRESA</h2></div>
        <div class="editCompanyDiv">
            <form :action="formRoute" class="editForm" method="POST">
            <ul>
            <li>
                <label for="title">Nome da empresa:</label> <br>
                <input type="text" id="title" name="title" :value="company.TITLE" required>
            </li>
            <li>
                <label for="">Receita Anual:</label> <br>
                <input type="text" name="revenue" :value="company.REVENUE">
            </li>    
            <li v-for="(phone, index, i) in phones">
                <label for="">Telefone {{index + 1}}</label><br/>
                <masked-input type="text" mask="11 (11) 11111-1111" :id="'phone[' + index + ']'" :name="'phone[' + index + ']'" :value="phone"/>
            </li>
            <li class="formButton">
                <button class="bitrixBtn" type="button" @click.prevent="addPhone">Adicionar Telefone</button>
            </li>
            <li v-for="(email, index, i) in emails">
                <label for="">E-mail {{index + 1}}</label><br/>
                <input type="text" :id="'email[' + index + ']'" :name="'email[' + index + ']'" :value="email">
            </li>
            <li class="formButton">
                    <button class="bitrixBtn" type="button" @click.prevent="addEmail">Adicionar E-mail</button>
            </li>
            <template v-for="(contact, index, i) in contacts">
                    <input class="hiddenInput" type="text" :id="'contact_id[' + index +']'" :name="'contact_id[' + index +']'" :value="contact.ID">
                <li>
                    <label for="">Nome do Contato {{index + 1}}:</label><br/>
                    <input type="text" :id="'contact_name[' + index + ']'" :name="'contact_name[' + index + ']'" :value="contact.NAME">
                </li>
                <li>    
                    <label for="">Sobrenome do Contato {{index + 1}}:</label><br/>
                    <input type="text" :id="'contact_lastname[' + index + ']'" :name="'contact_lastname[' + index + ']'" :value="contact.LAST_NAME">
                </li>
            </template>    
            <li class="formButton">
                    <button class="bitrixBtn" type="button" @click.prevent="addContact">Adicionar contato</button>
            </li>
            <li>
                <button type="submit" class="bitrixBtn saveBtn">Salvar</button>
                <a href="/"><button type="button" class="bitrixBtn backBtn">Voltar</button></a>
            </li>
            </ul>
            </form>
        </div>
    </div>
    </div>
</template>

<script>
import MaskedInput from 'vue-masked-input'

export default {

    props: {
        company: {
            type: Object
        },
        formRoute: {
            type: String
        }
    },
    data() {
        return { 
            phones: this.company.PHONE,
            emails: this.company.EMAIL,
            contacts: this.company.CONTACTS
        }
    },
    methods: {
        addPhone() {
            for (let i = 0; i < this.company.PHONE.length; i++) {
                this.company.PHONE[i] = document.getElementById(`phone[${i}]`).value
                console.log(document.getElementById(`phone[${i}]`).value)
            }
            this.company.PHONE.push('')
        },
        addEmail() {
            for (let i = 0; i < this.company.EMAIL.length; i++) {
                this.company.EMAIL[i] = document.getElementById(`email[${i}]`).value
                console.log(document.getElementById(`email[${i}]`).value)
            }
            this.company.EMAIL.push('')
        },
        addContact() {
            for (let i = 0; i < this.company.CONTACTS.length; i++) {
                this.company.CONTACTS[i].ID = document.getElementById(`contact_id[${i}]`).value
                this.company.CONTACTS[i].NAME = document.getElementById(`contact_name[${i}]`).value
                this.company.CONTACTS[i].LAST_NAME = document.getElementById(`contact_lastname[${i}]`).value
            }
            this.company.CONTACTS.push({
                ID: 0,
                NAME: "",
                LAST_NAME: ""
            })
        }
    },
    components: {
        MaskedInput
    }
}
</script>

<style scoped>
    .hiddenInput {
        display: none;
        visibility: hidden;
    }

    .editCompany {
        max-width: 100%;
        background: #fff;
        margin: 10px;
        padding: 20px;
    }

    .editHeading {
        font-weight: 900;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .editForm {
        max-width:400px;
        margin:30px;
        background:#fff;
        border-radius:2px;
        padding:20px;
    }

    .editForm ul {
        list-style:none;
        padding:0;
        margin:0;	
    }

    .editForm li {
        display: block;
        padding: 9px;
        border:1px solid #DDDDDD;
        margin-bottom: 20px;
        border-radius: 3px;
    }

    .editForm li:last-child {
        border:none;
        margin-bottom: 0px;
        text-align: center;
    }

    .editForm li > label {
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

    .editForm input[type="text"],
    .editForm input[type="email"]
    {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        width: 100%;
        display: block;
        outline: none;
        border: none;
        height: 15px;
        line-height: 30px;
        font-size: 16px;
        padding: 0;
    }

    .editForm input[type="text"]:focus,
    .editForm input[type="email"]:focus
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