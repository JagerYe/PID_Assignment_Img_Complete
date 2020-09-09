export class MemberViewModel {
    static getManagerView(id, phone, name,creationDate,changeDate) {
        return `<li class="row">
                    <div class="col">
                        <img src="/PID_Assignment_Img_Complete/views/img/gravatar.jpg"><br>
                    </div>
                    <div class="col">${id}</div>
                    <div class="col">${phone}</div>
                    <div class="col">${name}</div>
                    <div class="col">
                        <select id="select${id}" name="select${id}" class="custom-select">
                            <option value="1">啟用</option>
                            <option value="0">停用</option>
                        </select>
                    </div>
                    <div class="col">${creationDate}</div>
                    <div class="col">${changeDate}</div>
                    <div class="col">
                        <button type="button" name="btnShowOrder${id}" id="btnShowOrder${id}">過往訂單</button>
                    </div>
                </li>
                <ul id="orders${id}">
                </ul><br>`
            ;
    }
    static getStatus(status) {
        if (status) {
            return `<option value="1" SELECTED>啟用</option>
                    <option value="0">停用</option>`;
        }
        return `<option value="1">啟用</option>
                <option value="0" SELECTED>停用</option>`;

    }
}
