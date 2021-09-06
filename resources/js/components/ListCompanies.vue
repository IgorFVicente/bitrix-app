<template>
    <div class="listCompanies">
        <div class="listHeading"><h2>LISTA DE EMPRESAS</h2></div>
        <a href="/companies/new"><button class="bitrixBtn newBtn">Novo Registro</button></a>
        <hr class="divider"></hr>
        <table>
        <thead>
        <tr class="tableHead">
            <th class="tcolumn1">ID</th>
            <th class="tcolumn2">Empresa</th>
            <th class="tcolumn3">Receita Anual</th>
            <th class="tcolumn4">Telefones</th>
            <th class="tcolumn5">E-mails</th>
            <th class="tcolumn6">Contatos</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="company in companies" class="tableBody">
            <td class="tcolumn1">{{company.COMPANY_ID}}</td>
            <td class="tcolumn2">{{company.TITLE}}</td>
            <td class="tcolumn3">R${{company.REVENUE}}</td>
            <td class="tcolumn4">
                <p v-for="phone in company.PHONE">
                    {{phone}}
                </p>
            </td>
            <td class="tcolumn5">
                <p v-for="email in company.EMAIL">
                    {{email}}
                </p>
            </td>
            <td class="tcolumn6">
                <p v-for="contact in company.CONTACTS">
                    {{contact.NAME}} {{contact.LAST_NAME}}
                </p>
            </td>
            <td><a :href="'/companies/edit/' + company.COMPANY_ID"><button class="bitrixBtn">Editar</button></a></td>
            <td><a :href="'/companies/delete/' + company.COMPANY_ID"><button class="bitrixBtn deleteBtn">Excluir</button></a></td>
        </tr>
        </tbody>
        </table>
        </list-companies>
    </div>
    </div>
</template>

<script>
export default {
    props: {
        companies: {
            type: Array
        }
    }
}
</script>

<style scoped>

    .table {
        width: 100%;
    }
    
    .tableHead {
        border-bottom: 1px solid #f2f2f2;
        box-sizing: border-box;
    }

    .tableHead th {
        font-size: 14px;
        color: #333;
        line-height: 1.4;
        text-transform: uppercase;
        padding-top: 5px;
        padding-bottom: 15px;
        padding-right: 10px;
        padding-left: 30px;
        text-align: left;
    }

    .tableBody {
        border-bottom: 1px solid #f2f2f2;
        box-sizing: border-box;
    }

    .tableBody td {
        color: #999;
        font-size: 15px;
        line-height: 1.4;
        padding-top: 16px;
        padding-bottom: 16px;
        padding-right: 10px;
        padding-left: 30px;
        text-align: left;
        vertical-align: top;
    }

    .tcolumn1 {
        width: 80px;
    }

    .tcolumn2 {
        width: 200px;
    }

    .tcolumn3 {
        width: 160px;
    }

    .tcolumn4 {
        width: 150px;
    }

    .tcolumn5 {
        width: 200px;
    }
    
    .tcolumn6 {
        width: 200px;
    }

    .listCompanies {
        max-width: 100%;
        background: #fff;
        margin: 10px;
        padding: 20px;
    }

    .listHeading {
        font-weight: 900;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .divider {
        border: 1px solid #ddd;
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

    .deleteBtn {
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

    .deleteBtn:hover {
        background-color: #e56e6e;
        background-image: -webkit-linear-gradient(top, #ec8585, #dd5555);
        background-image: -moz-linear-gradient(top, #ec8585, #dd5555);
        background-image: -ms-linear-gradient(top, #ec8585, #dd5555);
        background-image: -o-linear-gradient(top, #ec8585, #dd5555);
        background-image: linear-gradient(to bottom, #ec8585, #dd5555);
        -webkit-box-shadow: inset 0 1px 0 #f6c2c2, 0 1px 1px 0 rgba(0, 0, 0, .23);
        box-shadow: inset 0 1px 0 #f6c2c2, 0 1px 1px 0 rgba(0, 0, 0, .23);
    }

    .deleteBtn:active {
        background: #bb3131 !important;
        border-color: #8b0202 #970d0d #af2525;
        -webkit-box-shadow: inset 0 1px 0 #970d0d, inset 0 2px 0 #af2525;
        box-shadow: inset 0 1px 0 #970d0d, inset 0 2px 0 #af2525;
        border-radius: 4px;
    }

    .newBtn {
        height: 40px !important;
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

    .newBtn:hover {
        background-color: #a9cf2f;
        background-image: -webkit-linear-gradient(top, #b5d534, #97c528);
        background-image: -moz-linear-gradient(top, #b5d534, #97c528);
        background-image: -ms-linear-gradient(top, #b5d534, #97c528);
        background-image: -o-linear-gradient(top, #b5d534, #97c528);
        background-image: linear-gradient(to bottom, #b5d534, #97c528);
    }
    .newBtn:active {
        background: #789e12 !important;
        border-color: #5c7619 #719414 #789e12;
        -webkit-box-shadow: inset 0 1px 0 #638017, inset 0 2px 0 #719414;
        box-shadow: inset 0 1px 0 #638017, inset 0 2px 0 #719414;
        border-radius: 4px;
    }
</style>