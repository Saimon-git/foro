<template>
    <div>
        <form>
            <button @click.prevent="upvote"
             :class="currentVote == 1 ? 'btn-primary' : 'btn-default'"
             class="btn">+1</button>
            Puntuacion actual : <strong id="current-score">{{currentScore}}</strong>
            <button @click.prevent="downvote" 
                :class="currentVote == -1 ? 'btn-primary' : 'btn-default'"
                class="btn">-1</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:[
            'score',
            'vote',
        ],
        data(){
            return {
                currentVote: this.vote ? parseInt(this.vote) : null,
                currentScore: parseInt(this.score),
            }
        },
        methods : {
            upvote() {
                this.addVote(1);

            },
            downvote() {
               this.addVote(-1);
            },
            addVote(amount) {
                if (this.currentVote == amount ) {

                    this.currentScore -= this.currentVote;

                    this.processRequest('delete', 'vote');

                    this.currentVote = null;                     
                }
                else{

                    this.currentScore += this.currentVote ? (amount * 2) : amount;

                    this.processRequest('post', amount == 1 ? 'upvote' : 'downvote');
                    
                    this.currentVote = amount; 
                }
            },
            processRequest(method, action) {
                axios[method](this.buildUrl()).then((response) => {
                        this.currentScore = response.data.new_score;    
                    });
            },
            buildUrl(action) {
                return window.location.href + '/'+ action;
            }

        }
    }
</script>