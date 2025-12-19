
<template>
  <div class="p-6">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-[24px] font-semibold text-[#e6edf3] mb-4">{{ question ? "Edit Your" : "Ask a public" }} question</h1>
      
      <!-- Info Box -->
      <div class="bg-[#1f6feb]/10 border border-[#1f6feb]/40 rounded-[3px] p-6">
        <h2 class="text-[18px] font-medium text-[#c9d1d9] mb-2">Writing a good question</h2>
        <p class="text-[13px] text-[#c9d1d9] mb-4">
          You’re ready to ask a programming-related question and this form will help guide you through the process.
        </p>
        <ul class="list-disc list-inside text-[13px] text-[#c9d1d9] space-y-1 ml-2">
          <li>Summarize your problem in a one-line title.</li>
          <li>Describe your problem in more detail.</li>
          <li>Describe what you tried and what you expected to happen.</li>
          <li>Add “tags” which help surface your question to members of the community.</li>
        </ul>
      </div>
    </div>

    <form @submit.prevent="submit" class="space-y-6">
      <!-- Title Section -->
      <div class="bg-[#161b22] border border-[#30363d] rounded-[3px] p-6 shadow-sm">
        <div class="mb-2">
          <label for="title" class="block text-[15px] font-semibold text-[#e6edf3]">
            Title
          </label>
          <p class="text-[12px] text-[#8b949e] mt-1">
            Be specific and imagine you’re asking a question to another person.
          </p>
        </div>
        <input
          id="title"
          v-model="form.title"
          type="text"
          class="w-full bg-[#0d1117] border border-[#30363d] rounded-[3px] px-3 py-2 text-[13px] text-[#c9d1d9] placeholder-[#8b949e] focus:ring-2 focus:ring-[#58a6ff]/40 focus:border-[#58a6ff] transition-all outline-none"
          placeholder="e.g. Is there an R function for finding the index of an element in a vector?"
        />
        <div v-if="form.errors.title" class="mt-2 text-red-400 text-xs">
          {{ form.errors.title }}
        </div>
      </div>

      <!-- Body Section -->
      <div class="bg-[#161b22] border border-[#30363d] rounded-[3px] p-6 shadow-sm">
        <div class="mb-2">
          <label for="body" class="block text-[15px] font-semibold text-[#e6edf3]">
            What are the details of your problem?
          </label>
          <p class="text-[12px] text-[#8b949e] mt-1">
            Introduce the problem and expand on what you put in the title. Minimum 20 characters.
          </p>
        </div>
        
        <!-- Toolbar Mock -->
        <div class="border border-[#30363d] rounded-[3px] overflow-hidden bg-[#0d1117]">
            <!-- Simple Markdown Toolbar -->
            <div class="flex items-center gap-1 px-2 py-2 border-b border-[#30363d] bg-[#161b22]/50">
                <button type="button" class="p-1.5 text-[#8b949e] hover:bg-[#30363d] hover:text-[#c9d1d9] rounded-[3px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12l-3-3m3 3l-3 3"></path></svg> <!-- Code mock -->
                </button>
                <button type="button" class="p-1.5 text-[#8b949e] hover:bg-[#30363d] hover:text-[#c9d1d9] rounded-[3px] font-bold serif">B</button>
                <button type="button" class="p-1.5 text-[#8b949e] hover:bg-[#30363d] hover:text-[#c9d1d9] rounded-[3px] italic serif">I</button>
                <button type="button" class="p-1.5 text-[#8b949e] hover:bg-[#30363d] hover:text-[#c9d1d9] rounded-[3px] font-mono">&lt;/&gt;</button>
            </div>
            <textarea
            id="body"
            v-model="form.body"
            rows="10"
            class="w-full bg-[#0d1117] border-0 px-3 py-3 text-[13px] text-[#c9d1d9] placeholder-[#8b949e] focus:ring-0 focus:outline-none resize-y min-h-[200px]"
            ></textarea>
        </div>
        
        <div v-if="form.errors.body" class="mt-2 text-red-400 text-xs">
          {{ form.errors.body }}
        </div>
      </div>

      <!-- Tags Section -->
      <div class="bg-[#161b22] border border-[#30363d] rounded-[3px] p-6 shadow-sm">
        <div class="mb-2">
          <label for="tags" class="block text-[15px] font-semibold text-[#e6edf3]">
            Tags
          </label>
          <p class="text-[12px] text-[#8b949e] mt-1">
            Add up to 5 tags to describe what your question is about.
          </p>
        </div>
        <input
          id="tags"
          v-model="form.tags"
          type="text"
          class="w-full bg-[#0d1117] border border-[#30363d] rounded-[3px] px-3 py-2 text-[13px] text-[#c9d1d9] placeholder-[#8b949e] focus:ring-2 focus:ring-[#58a6ff]/40 focus:border-[#58a6ff] transition-all outline-none"
          placeholder="e.g. (laravel vue.js inertia)"
        />
        <div v-if="form.errors.tags" class="mt-2 text-red-400 text-xs">
          {{ form.errors.tags }}
        </div>
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-4 pt-2">
        <button
          type="submit"
          :disabled="form.processing"
          class="bg-[#1f6feb] hover:bg-[#388bfd] text-white text-[13px] font-medium px-4 py-2.5 rounded-[3px] border border-[rgba(240,246,252,0.1)] shadow-sm transition-colors disabled:opacity-50"
        >
          {{question ? "Update" : "Post your"}} question
        </button>
        <button
            type="button"
             class="text-[#c9d1d9] hover:bg-[#21262d] text-[13px] font-medium px-4 py-2.5 rounded-[3px] transition-colors"
        >
            Discard draft
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props : {
    question : Object | null
  },
  data() {
    return {
      form :this.$inertia.form({
        title : this.question?.title,
        body : this.question?.body,
        tags : []
      })
    }
  },
  methods : {
    submit(){
      if(this.question) {
        this.form.put("/questions/"+this.question.id+"/update")
      }else {
        this.form.post("/questions/store")
      }
    }
  }
}
</script>