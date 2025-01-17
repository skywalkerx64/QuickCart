<script setup lang="ts">
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/Components/ui/accordion";
interface FAQProps {
    question: string;
    answer: string;
    id: number;
}

const FAQList: FAQProps[] = [
  {
    id: 1,
    question: "How can I track my order?",
    answer: "You can track your order by visiting the 'My Orders' section in your account and clicking on the 'Track Order' button.",
  },
  {
    id: 2,
    question: "What is your return policy?",
    answer: "We offer a 30-day return policy for unused items in their original packaging. Visit our Returns page for detailed instructions.",
  },
  {
    id: 3,
    question: "What payment methods do you accept?",
    answer: "We accept KkiaPay and FedaPay. Check the checkout page for the full list of options.",
  },
  {
    id: 4,
    question: "Do you offer international shipping?",
    answer: "Yes, we ship to select countries worldwide. Shipping costs and delivery times may vary depending on your location.",
  },
  {
    id: 5,
    question: "How can I contact customer support?",
    answer: "You can reach our customer support team via email at support@example.com or through our 24/7 live chat feature.",
  },
];
</script>

<template>
    <section id="faq" class="container md:w-[700px] py-20 sm:py-24">
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl text-center font-bold">
                Common Questions
            </h2>
        </div>

        <Accordion type="single" collapsible class="AccordionRoot">
            <AccordionItem
                v-for="{ question, answer, id } in FAQList"
                :key="id"
                :value="id.toString()"
            >
                <AccordionTrigger class="text-left">
                    {{ question }}
                </AccordionTrigger>

                <AccordionContent>{{ answer }}</AccordionContent>
            </AccordionItem>
        </Accordion>

        <h3 class="font-medium mt-4">
            Still have questions?
            <span href="#" class="text-muted-foreground">
                <a href="/contact" class="underline">Contact us</a>
            </span>
        </h3>
    </section>
</template>
