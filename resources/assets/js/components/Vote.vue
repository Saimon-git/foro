<template>
    <div>
        <form>
            <button @click.prevent="upvote"
             :class="currentVote == 1 ? 'btn-primary' : 'btn-default'"
             :disabled="voteInProgress"
             class="btn">+1</button>
            Puntuacion actual : <strong class="current-score">{{currentScore}}</strong>
            <button @click.prevent="downvote" 
                :class="currentVote == -1 ? 'btn-primary' : 'btn-default'"
                :disabled="voteInProgress"
                class="btn">-1</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:[
            'score',
            'vote',
            'votable_id',
            'module',
        ],
        data(){
            return {
                currentVote: this.vote ? parseInt(this.vote) : null,
                currentScore: parseInt(this.score),
                voteInProgress: false,
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

                this.voteInProgress = true;

                if (this.currentVote == amount ) {

                    //this.currentScore -= this.currentVote;

                    this.processRequest('delete', 'vote');

                    this.currentVote = null;                     
                }
                else{

                    //this.currentScore += this.currentVote ? (amount * 2) : amount;

                    this.processRequest('post', amount == 1 ? 'upvote' : 'downvote');
                    
                    this.currentVote = amount; 
                }
            },
            processRequest(method, action) {
                axios[method](this.buildUrl(action)).then((response) => {
                        this.currentScore = response.data.new_score;
                        
                        this.voteInProgress = false;
                    }).catch((thrown) =>  {
                        alert('Ocurrio un error!');

                        this.voteInProgress = false;
                    });
            },
            buildUrl(action) {
                return '/'+this.module+'/' + this.votable_id + '/'+ action;
            }

        }
    }
</script>