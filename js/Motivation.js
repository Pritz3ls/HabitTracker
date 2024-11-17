//for diff motivational qoutes
function showSweetAlert() {
    //  display the random quote
    Swal.fire({
        title: 'Stay Motivated!',
        text: GetMotivationQuotes(),
        icon: 'success',
        confirmButtonText: 'Keep Going'
    })
}
function GetMotivationQuotes(){
    // Array of motivational quotes
    const quotes = [
        "“Small steps every day lead to big changes over time.”",
        "“Success is the sum of small efforts repeated day in and day out.”",
        "“Good habits formed today shape tomorrow’s success.”",
        "“It’s the habits you do daily that create the life you want.”",
        "“Consistency in habits turns mountains into hills.”",
        "“Focus on building small habits, not just big goals.”",
        "“Your habits are the blueprint for your future.”",
        "“One habit at a time, one day at a time.”",
        "“The best way to start a habit is to simply start.”",
        "“The secret of your success is found in your daily routine.”",
        "“Every action you take is a vote for the person you wish to become.”",
        "“Habits shape your identity; choose them wisely.”",
        "“Change your habits, change your life.”",
        "“Big results require small, consistent actions.”",
        "“Success doesn’t come from what you do occasionally; it comes from what you do consistently.”",
        "“Your future self is created by what you do today.”",
        "“Small habits practiced consistently are more powerful than large goals attempted occasionally.”",
        "“Success is found in your daily routine.”",
        "“Choose your habits; they’ll choose your future.”",
        "“You are what you repeatedly do.”",
        "“It’s not about perfect; it’s about effort.”",
        "“Small habits can make a big impact over time.”",
        "“A habit is simply a choice that you keep making.”",
        "“The key to lasting change is consistency.”",
        "“Don’t break the chain. Keep going.”",
        "“Habits are the compound interest of self-improvement.”",
        "“Your daily habits determine your destiny.”",
        "“Progress, not perfection.”",
        "“Little by little, one goes far.”",
        "“Every habit starts with a single step.”",
        "“Keep showing up, no matter how small the step.”",
        "“Your habits are a compass for your future.”",
        "“Habits are the invisible architecture of daily life.”",
        "“Tiny habits lead to big changes.”",
        "“One day or day one; you decide.”",
        "“The quality of your life is a reflection of the habits you choose.”",
        "“Small, daily efforts build extraordinary results.”",
        "“Success is a journey of small steps taken consistently.”",
        "“Choose habits that make you feel proud.”",
        "“Each small effort brings you closer to the finish line.”",
        "“You don’t have to be great to start, but you have to start to be great.”",
        "“Great achievements come from small, consistent steps.”",
        "“Start where you are. Use what you have. Do what you can.”",
        "“Habits are the gears that drive the machine of life.”",
        "“Progress happens one habit at a time.”",
        "“Focus on habits, and the results will follow.”",
        "“It’s never too late to build a habit.”",
        "“Your habits are a window into your future.”",
        "“Daily habits are the foundation of your dreams.”",
        "“Start small but think big.”",
        "“The secret of your success is in your daily habits.”",
        "“Your future is written by the habits you practice today.”",
        "“Change your habits, and you’ll change your life.”",
        "“Habits grow stronger with time, so choose them wisely.”",
        "“Every day brings a new chance to strengthen your habits.”",
        "“The journey of a thousand miles begins with a single habit.”",
        "“Habits are the steps on the path to your dreams.”",
        "“Build habits that serve your goals.”",
        "“Consistency is the magic behind habit formation.”",
        "“Every day, build a small part of your dream with your habits.”",
        "“Your habits are the stepping stones to your goals.”",
        "“When in doubt, focus on your daily habits.”",
        "“It’s the small habits repeated daily that lead to great results.”",
        "“Growth is fueled by small, consistent habits.”",
        "“A great habit today creates a better tomorrow.”",
        "“Your actions today determine your future habits.”",
        "“Tiny habits are the seeds of massive transformation.”",
        "“Small actions lead to big outcomes over time.”",
        "“Build habits that build you up.”",
        "“Let your habits be the engine that drives your success.”",
        "“Habit is the foundation of resilience.”",
        "“Every day you keep going, your habits grow stronger.”",
        "“Success is found in the habits you don’t see.”",
        "“Be patient; habits take time to grow.”",
        "“One step at a time, one habit at a time.”",
        "“Habits are choices made over and over.”",
        "“Success is built on a series of small habits.”",
        "“Your habits are your quiet victories.”",
        "“Consistency beats intensity.”",
        "“Great things happen to those who keep good habits.”",
        "“Habits are the quiet builders of our lives.”",
        "“You are the architect of your habits.”",
        "“A habit starts with one choice and grows with consistency.”",
        "“Build habits that build your dreams.”",
        "“Habits are the anchors of a purposeful life.”",
        "“Your habits are the groundwork for your success.”",
        "“The small things you do every day become the big things.”",
        "“Greatness is the result of great habits.”",
        "“Habits create the structure of your life.”",
        "“The best investment is in your habits.”",
        "“Habits turn wishes into achievements.”",
        "“Choose habits that inspire growth.”",
        "“Let your habits reflect your values.”",
        "“Little things done daily make a big difference.”",
        "“The habit of persistence will take you places.”",
        "“Believe in the power of consistent habits.”",
        "“Habits make all the difference.”",
        "“Progress is made in the quiet repetition of habits.”",
        "“Nurture habits that nourish your goals.”",
        "“Every new habit brings new possibilities.”",
        "“Let your daily habits speak of your dreams.”"
    ];
    // Select a random quote 
    const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
    return randomQuote;
}