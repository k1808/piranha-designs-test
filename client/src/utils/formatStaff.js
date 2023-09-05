export function formatStaff(data) {
    let arr = [];

    for (let obj of data) {
        if (!obj.status) {
            arr.push({
                id: obj.id,
                name: obj.name,
                email: obj.email,
                last_operations: null,
                status: true
            });
        } else {
            for (let operation of obj.last_operations) {
                arr.push({
                    id: obj.id,
                    name: obj.name,
                    email: obj.email,
                    last_operations: operation,
                    status: true
                });
            }
        }
    }

    return arr;
}