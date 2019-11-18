class Queue{
    constructor(){
        this.queue = [];
    }

    add(fn){
        this.queue.push(fn);
        if(this.queue.length === 1){
            fn();
        }
    }

    next(){
        this.queue.shift();
        if(this.queue.length){
            this.queue[0]();
        }
    }
}

export default Queue;